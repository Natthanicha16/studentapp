<?php

namespace PHPMaker2022\STUDENTT;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AddressAdd extends Address
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'address';

    // Page object name
    public $PageObjName = "AddressAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (address)
        if (!isset($GLOBALS["address"]) || get_class($GLOBALS["address"]) == PROJECT_NAMESPACE . "address") {
            $GLOBALS["address"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'address');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("address");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "addressview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['address_id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->address_id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->address_id->Visible = false;
        $this->address_studentcode->setVisibility();
        $this->address_moo->setVisibility();
        $this->address_name->setVisibility();
        $this->address_sub->setVisibility();
        $this->address_district->setVisibility();
        $this->address_province->setVisibility();
        $this->address_zip->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("address_id") ?? Route("address_id")) !== null) {
                $this->address_id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("addresslist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "addresslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "addressview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->address_id->CurrentValue = null;
        $this->address_id->OldValue = $this->address_id->CurrentValue;
        $this->address_studentcode->CurrentValue = null;
        $this->address_studentcode->OldValue = $this->address_studentcode->CurrentValue;
        $this->address_moo->CurrentValue = null;
        $this->address_moo->OldValue = $this->address_moo->CurrentValue;
        $this->address_name->CurrentValue = null;
        $this->address_name->OldValue = $this->address_name->CurrentValue;
        $this->address_sub->CurrentValue = null;
        $this->address_sub->OldValue = $this->address_sub->CurrentValue;
        $this->address_district->CurrentValue = null;
        $this->address_district->OldValue = $this->address_district->CurrentValue;
        $this->address_province->CurrentValue = null;
        $this->address_province->OldValue = $this->address_province->CurrentValue;
        $this->address_zip->CurrentValue = null;
        $this->address_zip->OldValue = $this->address_zip->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'address_studentcode' first before field var 'x_address_studentcode'
        $val = $CurrentForm->hasValue("address_studentcode") ? $CurrentForm->getValue("address_studentcode") : $CurrentForm->getValue("x_address_studentcode");
        if (!$this->address_studentcode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_studentcode->Visible = false; // Disable update for API request
            } else {
                $this->address_studentcode->setFormValue($val);
            }
        }

        // Check field name 'address_moo' first before field var 'x_address_moo'
        $val = $CurrentForm->hasValue("address_moo") ? $CurrentForm->getValue("address_moo") : $CurrentForm->getValue("x_address_moo");
        if (!$this->address_moo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_moo->Visible = false; // Disable update for API request
            } else {
                $this->address_moo->setFormValue($val);
            }
        }

        // Check field name 'address_name' first before field var 'x_address_name'
        $val = $CurrentForm->hasValue("address_name") ? $CurrentForm->getValue("address_name") : $CurrentForm->getValue("x_address_name");
        if (!$this->address_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_name->Visible = false; // Disable update for API request
            } else {
                $this->address_name->setFormValue($val);
            }
        }

        // Check field name 'address_sub' first before field var 'x_address_sub'
        $val = $CurrentForm->hasValue("address_sub") ? $CurrentForm->getValue("address_sub") : $CurrentForm->getValue("x_address_sub");
        if (!$this->address_sub->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_sub->Visible = false; // Disable update for API request
            } else {
                $this->address_sub->setFormValue($val);
            }
        }

        // Check field name 'address_district' first before field var 'x_address_district'
        $val = $CurrentForm->hasValue("address_district") ? $CurrentForm->getValue("address_district") : $CurrentForm->getValue("x_address_district");
        if (!$this->address_district->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_district->Visible = false; // Disable update for API request
            } else {
                $this->address_district->setFormValue($val);
            }
        }

        // Check field name 'address_province' first before field var 'x_address_province'
        $val = $CurrentForm->hasValue("address_province") ? $CurrentForm->getValue("address_province") : $CurrentForm->getValue("x_address_province");
        if (!$this->address_province->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_province->Visible = false; // Disable update for API request
            } else {
                $this->address_province->setFormValue($val);
            }
        }

        // Check field name 'address_zip' first before field var 'x_address_zip'
        $val = $CurrentForm->hasValue("address_zip") ? $CurrentForm->getValue("address_zip") : $CurrentForm->getValue("x_address_zip");
        if (!$this->address_zip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address_zip->Visible = false; // Disable update for API request
            } else {
                $this->address_zip->setFormValue($val);
            }
        }

        // Check field name 'address_id' first before field var 'x_address_id'
        $val = $CurrentForm->hasValue("address_id") ? $CurrentForm->getValue("address_id") : $CurrentForm->getValue("x_address_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->address_studentcode->CurrentValue = $this->address_studentcode->FormValue;
        $this->address_moo->CurrentValue = $this->address_moo->FormValue;
        $this->address_name->CurrentValue = $this->address_name->FormValue;
        $this->address_sub->CurrentValue = $this->address_sub->FormValue;
        $this->address_district->CurrentValue = $this->address_district->FormValue;
        $this->address_province->CurrentValue = $this->address_province->FormValue;
        $this->address_zip->CurrentValue = $this->address_zip->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->address_id->setDbValue($row['address_id']);
        $this->address_studentcode->setDbValue($row['address_studentcode']);
        $this->address_moo->setDbValue($row['address_moo']);
        $this->address_name->setDbValue($row['address_name']);
        $this->address_sub->setDbValue($row['address_sub']);
        $this->address_district->setDbValue($row['address_district']);
        $this->address_province->setDbValue($row['address_province']);
        $this->address_zip->setDbValue($row['address_zip']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['address_id'] = $this->address_id->CurrentValue;
        $row['address_studentcode'] = $this->address_studentcode->CurrentValue;
        $row['address_moo'] = $this->address_moo->CurrentValue;
        $row['address_name'] = $this->address_name->CurrentValue;
        $row['address_sub'] = $this->address_sub->CurrentValue;
        $row['address_district'] = $this->address_district->CurrentValue;
        $row['address_province'] = $this->address_province->CurrentValue;
        $row['address_zip'] = $this->address_zip->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // address_id
        $this->address_id->RowCssClass = "row";

        // address_studentcode
        $this->address_studentcode->RowCssClass = "row";

        // address_moo
        $this->address_moo->RowCssClass = "row";

        // address_name
        $this->address_name->RowCssClass = "row";

        // address_sub
        $this->address_sub->RowCssClass = "row";

        // address_district
        $this->address_district->RowCssClass = "row";

        // address_province
        $this->address_province->RowCssClass = "row";

        // address_zip
        $this->address_zip->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // address_id
            $this->address_id->ViewValue = $this->address_id->CurrentValue;
            $this->address_id->ViewCustomAttributes = "";

            // address_studentcode
            $this->address_studentcode->ViewValue = $this->address_studentcode->CurrentValue;
            $this->address_studentcode->ViewCustomAttributes = "";

            // address_moo
            $this->address_moo->ViewValue = $this->address_moo->CurrentValue;
            $this->address_moo->ViewCustomAttributes = "";

            // address_name
            $this->address_name->ViewValue = $this->address_name->CurrentValue;
            $this->address_name->ViewCustomAttributes = "";

            // address_sub
            $this->address_sub->ViewValue = $this->address_sub->CurrentValue;
            $this->address_sub->ViewCustomAttributes = "";

            // address_district
            $this->address_district->ViewValue = $this->address_district->CurrentValue;
            $this->address_district->ViewCustomAttributes = "";

            // address_province
            $this->address_province->ViewValue = $this->address_province->CurrentValue;
            $this->address_province->ViewCustomAttributes = "";

            // address_zip
            $this->address_zip->ViewValue = $this->address_zip->CurrentValue;
            $this->address_zip->ViewCustomAttributes = "";

            // address_studentcode
            $this->address_studentcode->LinkCustomAttributes = "";
            $this->address_studentcode->HrefValue = "";

            // address_moo
            $this->address_moo->LinkCustomAttributes = "";
            $this->address_moo->HrefValue = "";

            // address_name
            $this->address_name->LinkCustomAttributes = "";
            $this->address_name->HrefValue = "";

            // address_sub
            $this->address_sub->LinkCustomAttributes = "";
            $this->address_sub->HrefValue = "";

            // address_district
            $this->address_district->LinkCustomAttributes = "";
            $this->address_district->HrefValue = "";

            // address_province
            $this->address_province->LinkCustomAttributes = "";
            $this->address_province->HrefValue = "";

            // address_zip
            $this->address_zip->LinkCustomAttributes = "";
            $this->address_zip->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // address_studentcode
            $this->address_studentcode->setupEditAttributes();
            $this->address_studentcode->EditCustomAttributes = "";
            if ($this->address_studentcode->getSessionValue() != "") {
                $this->address_studentcode->CurrentValue = GetForeignKeyValue($this->address_studentcode->getSessionValue());
                $this->address_studentcode->ViewValue = $this->address_studentcode->CurrentValue;
                $this->address_studentcode->ViewCustomAttributes = "";
            } else {
                if (!$this->address_studentcode->Raw) {
                    $this->address_studentcode->CurrentValue = HtmlDecode($this->address_studentcode->CurrentValue);
                }
                $this->address_studentcode->EditValue = HtmlEncode($this->address_studentcode->CurrentValue);
                $this->address_studentcode->PlaceHolder = RemoveHtml($this->address_studentcode->caption());
            }

            // address_moo
            $this->address_moo->setupEditAttributes();
            $this->address_moo->EditCustomAttributes = "";
            if (!$this->address_moo->Raw) {
                $this->address_moo->CurrentValue = HtmlDecode($this->address_moo->CurrentValue);
            }
            $this->address_moo->EditValue = HtmlEncode($this->address_moo->CurrentValue);
            $this->address_moo->PlaceHolder = RemoveHtml($this->address_moo->caption());

            // address_name
            $this->address_name->setupEditAttributes();
            $this->address_name->EditCustomAttributes = "";
            if (!$this->address_name->Raw) {
                $this->address_name->CurrentValue = HtmlDecode($this->address_name->CurrentValue);
            }
            $this->address_name->EditValue = HtmlEncode($this->address_name->CurrentValue);
            $this->address_name->PlaceHolder = RemoveHtml($this->address_name->caption());

            // address_sub
            $this->address_sub->setupEditAttributes();
            $this->address_sub->EditCustomAttributes = "";
            if (!$this->address_sub->Raw) {
                $this->address_sub->CurrentValue = HtmlDecode($this->address_sub->CurrentValue);
            }
            $this->address_sub->EditValue = HtmlEncode($this->address_sub->CurrentValue);
            $this->address_sub->PlaceHolder = RemoveHtml($this->address_sub->caption());

            // address_district
            $this->address_district->setupEditAttributes();
            $this->address_district->EditCustomAttributes = "";
            if (!$this->address_district->Raw) {
                $this->address_district->CurrentValue = HtmlDecode($this->address_district->CurrentValue);
            }
            $this->address_district->EditValue = HtmlEncode($this->address_district->CurrentValue);
            $this->address_district->PlaceHolder = RemoveHtml($this->address_district->caption());

            // address_province
            $this->address_province->setupEditAttributes();
            $this->address_province->EditCustomAttributes = "";
            if (!$this->address_province->Raw) {
                $this->address_province->CurrentValue = HtmlDecode($this->address_province->CurrentValue);
            }
            $this->address_province->EditValue = HtmlEncode($this->address_province->CurrentValue);
            $this->address_province->PlaceHolder = RemoveHtml($this->address_province->caption());

            // address_zip
            $this->address_zip->setupEditAttributes();
            $this->address_zip->EditCustomAttributes = "";
            if (!$this->address_zip->Raw) {
                $this->address_zip->CurrentValue = HtmlDecode($this->address_zip->CurrentValue);
            }
            $this->address_zip->EditValue = HtmlEncode($this->address_zip->CurrentValue);
            $this->address_zip->PlaceHolder = RemoveHtml($this->address_zip->caption());

            // Add refer script

            // address_studentcode
            $this->address_studentcode->LinkCustomAttributes = "";
            $this->address_studentcode->HrefValue = "";

            // address_moo
            $this->address_moo->LinkCustomAttributes = "";
            $this->address_moo->HrefValue = "";

            // address_name
            $this->address_name->LinkCustomAttributes = "";
            $this->address_name->HrefValue = "";

            // address_sub
            $this->address_sub->LinkCustomAttributes = "";
            $this->address_sub->HrefValue = "";

            // address_district
            $this->address_district->LinkCustomAttributes = "";
            $this->address_district->HrefValue = "";

            // address_province
            $this->address_province->LinkCustomAttributes = "";
            $this->address_province->HrefValue = "";

            // address_zip
            $this->address_zip->LinkCustomAttributes = "";
            $this->address_zip->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->address_studentcode->Required) {
            if (!$this->address_studentcode->IsDetailKey && EmptyValue($this->address_studentcode->FormValue)) {
                $this->address_studentcode->addErrorMessage(str_replace("%s", $this->address_studentcode->caption(), $this->address_studentcode->RequiredErrorMessage));
            }
        }
        if ($this->address_moo->Required) {
            if (!$this->address_moo->IsDetailKey && EmptyValue($this->address_moo->FormValue)) {
                $this->address_moo->addErrorMessage(str_replace("%s", $this->address_moo->caption(), $this->address_moo->RequiredErrorMessage));
            }
        }
        if ($this->address_name->Required) {
            if (!$this->address_name->IsDetailKey && EmptyValue($this->address_name->FormValue)) {
                $this->address_name->addErrorMessage(str_replace("%s", $this->address_name->caption(), $this->address_name->RequiredErrorMessage));
            }
        }
        if ($this->address_sub->Required) {
            if (!$this->address_sub->IsDetailKey && EmptyValue($this->address_sub->FormValue)) {
                $this->address_sub->addErrorMessage(str_replace("%s", $this->address_sub->caption(), $this->address_sub->RequiredErrorMessage));
            }
        }
        if ($this->address_district->Required) {
            if (!$this->address_district->IsDetailKey && EmptyValue($this->address_district->FormValue)) {
                $this->address_district->addErrorMessage(str_replace("%s", $this->address_district->caption(), $this->address_district->RequiredErrorMessage));
            }
        }
        if ($this->address_province->Required) {
            if (!$this->address_province->IsDetailKey && EmptyValue($this->address_province->FormValue)) {
                $this->address_province->addErrorMessage(str_replace("%s", $this->address_province->caption(), $this->address_province->RequiredErrorMessage));
            }
        }
        if ($this->address_zip->Required) {
            if (!$this->address_zip->IsDetailKey && EmptyValue($this->address_zip->FormValue)) {
                $this->address_zip->addErrorMessage(str_replace("%s", $this->address_zip->caption(), $this->address_zip->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Check referential integrity for master table 'address'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["address_studentcode"] = $this->address_studentcode->CurrentValue;
        $masterTable = Container("students");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "students", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // address_studentcode
        $this->address_studentcode->setDbValueDef($rsnew, $this->address_studentcode->CurrentValue, "", false);

        // address_moo
        $this->address_moo->setDbValueDef($rsnew, $this->address_moo->CurrentValue, null, false);

        // address_name
        $this->address_name->setDbValueDef($rsnew, $this->address_name->CurrentValue, "", false);

        // address_sub
        $this->address_sub->setDbValueDef($rsnew, $this->address_sub->CurrentValue, "", false);

        // address_district
        $this->address_district->setDbValueDef($rsnew, $this->address_district->CurrentValue, "", false);

        // address_province
        $this->address_province->setDbValueDef($rsnew, $this->address_province->CurrentValue, "", false);

        // address_zip
        $this->address_zip->setDbValueDef($rsnew, $this->address_zip->CurrentValue, "", false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "students") {
                $validMaster = true;
                $masterTbl = Container("students");
                if (($parm = Get("fk_student_code", Get("address_studentcode"))) !== null) {
                    $masterTbl->student_code->setQueryStringValue($parm);
                    $this->address_studentcode->setQueryStringValue($masterTbl->student_code->QueryStringValue);
                    $this->address_studentcode->setSessionValue($this->address_studentcode->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "students") {
                $validMaster = true;
                $masterTbl = Container("students");
                if (($parm = Post("fk_student_code", Post("address_studentcode"))) !== null) {
                    $masterTbl->student_code->setFormValue($parm);
                    $this->address_studentcode->setFormValue($masterTbl->student_code->FormValue);
                    $this->address_studentcode->setSessionValue($this->address_studentcode->FormValue);
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "students") {
                if ($this->address_studentcode->CurrentValue == "") {
                    $this->address_studentcode->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("addresslist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
