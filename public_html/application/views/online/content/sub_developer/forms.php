<?php
/**
 * Page Security
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class=" large-card card-shadow">
    <div class="card-content">
        <form>
            <div class="card-title "> Form </div>
            <p>You may also swap<code> .row</code> for<code> .form-row</code>, a variation of our standard grid row that overrides the default column gutters for tighter and more compact layouts.</p>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name">
                </div>
            </div>
        </form>
        <br>
        <form>
            <div class="card-title ">Checkboxes</div>
            <p>Each checkbox and radio input and label pairing is wrapped in a div to create our custom control. Structurally, this is the same approach as our default .form-check. </p>

            <div class="form-row">
                <p>Inline checkbox </p>
                <div class="col">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">Toggle this custom radio</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Or toggle this other custom radio</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <div class="col-sm-2">Checkbox</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Example checkbox
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <br>
        <form>
            <div class="card-title "> Horizontal form</div>
            <p>Create horizontal forms with the grid by adding the .row class to form groups and using the <code> .col-*-* </code>classes to specify the width of your labels and controls. Be sure to add .col-form-label to your <label>s as well so they’re vertically centered with their associated form controls.
                    At times, you maybe need to use margin or padding utilities to create that perfect alignment you need. For example, we’ve removed the padding-top on our stacked radio inputs label to better align the text baseline.
            </p>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Enter Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Enter Address">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Enter City">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Contact #</label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Enter Contact #">
                </div>
            </div>
        </form>
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                        <label class="form-check-label" for="gridRadios1">
                            First radio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                        <label class="form-check-label" for="gridRadios2">
                            Second radio
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                        <label class="form-check-label" for="gridRadios3">
                            Third disabled radio
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="input-group col-6">
            <div class="input-group-prepend">
                <label for="inputEmail3" class="col-4 col-form-label">Textarea</label>
            </div>
            <textarea class="form-control" aria-label="With textarea"></textarea>
        </div>

        <form>
            <div class="card-title ">File browser</div>
            <p>The file input is the most gnarly of the bunch and requires additional JavaScript if you’d like to hook them up with functional Choose file… and selected file name text.  </p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </form>

    </div>
</div>