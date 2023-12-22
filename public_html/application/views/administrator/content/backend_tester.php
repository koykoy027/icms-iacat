
<style type="text/css">
    i{
        color: white;
    }
    b{
        color: blue;
    }
    
</style>
<div class="js-fix-footer2 bg-white border-top-2">
    <div class="container-fluid page__container page-section d-flex flex-column">
        <div class="row">
            <div class="col-md-5">

                <form id="form-test" onSubmit="return false">

                    <div class="col-12 align-items-center">
                        <div class="flex">
                            <div class="form-group">
                                <label class="form-label" for="function_name">Function Name:</label>
                                <input type="text" class="form-control" name="function_name" id="function_name" placeholder="Enter function name">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="ajaxUrl">Ajax Url:</label>
                                <select id="ajaxUrl" name="ajaxUrl" class="form-control">
                                    <option value="">Select AjaxUrl</option>
                                    <option value="sAjaxTemporaryCase">sAjaxTemporaryCase</option>
                                    <option value="sAjaxAgencies">sAjaxAgencies</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 1</label>
                                <input type="text" class="form-control" name="param1" id="param1" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value1" id="value1" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param2">Param 2</label>
                                <input type="text" class="form-control" name="param2" id="param2" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value2" id="value2" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 3</label>
                                <input type="text" class="form-control" name="param3" id="param3" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value3" id="value3" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 4</label>
                                <input type="text" class="form-control" name="param4" id="param4" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value4" id="value4" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 5</label>
                                <input type="text" class="form-control" name="param5" id="param5" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value5" id="value5" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 6</label>
                                <input type="text" class="form-control" name="param6" id="param6" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value6" id="value6" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 7</label>
                                <input type="text" class="form-control" name="param7" id="param7" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value7" id="value7" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 8</label>
                                <input type="text" class="form-control" name="param8" id="param8" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value8" id="value8" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 9</label>
                                <input type="text" class="form-control" name="param9" id="param9" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value9" id="value9" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 10</label>
                                <input type="text" class="form-control" name="param10" id="param10" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value10" id="value10" placeholder="Value">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="param1">Param 11</label>
                                <input type="text" class="form-control" name="param11" id="param11" placeholder="Parameter name">
                                <input type="text" class="form-control" name="value11" id="value11" placeholder="Value">
                            </div>
                            <div class="text-right mt-5">
                                <button type="submit" class="btn btn-primary mx-3s">Submit</button>
                                <button type="reset" value="Clear" id="reset" class="btn btn-danger mx-3">Clear</button>
                            </div>

                        </div>
                    </div>

                </form>
                <br>
                <br>
                <form onSubmit="return false" id="form-add_document" enctype="multipart/form-data">
                    <fieldset class="form-group">
                        <label class="file_upload" for="basicInput">File upload:</label> <span
                            class="required">*</span>
                        <div class="custom-file">
                            <!-- <input type="file" name="document_hash" class="custom-file-input"
                                accept="application/msword, application/pdf, image/*, video/mp4"> -->
                            <input type="file" name="document_hash" class="custom-file-input"
                                   accept=".csv">
                            <label class="custom-file-label d-flex" id="lbl-document_hash"
                                   for="document_hash">
                            </label>
                        </div>
                    </fieldset>
                    <div class="col-md-12">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            <div class="col-md-7">
                <div class="">
                    <div id="console"
                         style="font-color:green;margin-right:5px;background:black;font-size:12px;padding-left:3px;height:1200px;overflow-y:scroll;overflow-x:scroll;width:100%">
                        Output
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="page-section bg-alt border-bottom-2">
    <div class="">
        <div class="page-section">
            <div class="">



            </div>
        </div>

    </div>
</div>
