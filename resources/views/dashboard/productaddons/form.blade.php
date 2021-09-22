<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.header')

<body class="">
<div class="wrapper">
    @include('dashboard.layouts.sidebar')
     <div class="main-panel" id="main-panel">
        @include('dashboard.layouts.navbar')
        <div class="container" style="margin-top:10%;">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ $action }} @lang('Product Addon') @if($addon != null) {{ $addon->name }} @endif</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="dashboardForm" action="{{ ($addon) ? route('dashboard.productaddons.edit', [$addon->id]) : route('dashboard.productaddons.create') }}">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="category">@lang('Product')</label><span class="text-danger"><small> - @lang('Required')</small></span>
                                <select class="form-control" id="product" name="product">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @if($addon != null && $addon->product_id == $product->id) selected @endif >{{ $product->name }} - {{ $product->game->game_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>English Translation</h3>
                                <div class="form-group">
                                    <label for="nameEN">@lang('Addon Name')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameEN" id="nameEN" placeholder="@lang('Please Enter An Addon Name')" value="{{ ($addon != null) ? $addon->getTranslation('name','en') : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">@lang('Addon Description')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <textarea name="descriptionEN" class="form-control" required>{{ ($addon != null) ? $addon->getTranslation('description','en') : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Arabic Translation</h3>
                                <div class="form-group">
                                    <label for="nameAR">@lang('Addon Name')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <input class="form-control" type="text" name="nameAR" id="nameAR" placeholder="@lang('Please Enter An Addon Name')" value="{{ ($addon != null) ? $addon->getTranslation('name','ar') : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">@lang('Addon Description')<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                    <textarea name="descriptionAR" class="form-control"required>{{ ($addon != null) ? $addon->getTranslation('description','ar') : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="addon_order">Addon Order<span class="text-danger"><small> - @lang('Required')</small></span></label>
                          <input class="form-control" type="number" min="0" max="1000" name="addon_order" id="addon_order" placeholder="@lang('Please Enter An Addon Order')" value="{{ ($addon != null) ? $addon->addon_order : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="price">@lang('Addon Percent')<span class="text-danger"><small> - @lang('Required')</small></span></label><br>
                            <small class="text-info">@lang('Note: This will be the % of the products price, added on. For example, if the product is $100 and you enter 10% here, it will add $10 onto $100 when the customer selects this addon.')
                                <br>@lang('If you wish for this addon to be free, simply enter 0 in the input field.')</small>
                            <input class="form-control" type="number" min="0" max="1000" name="price" id="price" placeholder="@lang('Please Enter An Addon Price Percentage')" value="{{ ($addon != null) ? $addon->price_in_percent : '' }}" required>
                        </div>
                        <div class="form-group">
                          <label for="hide_price">Hide Price<span class="text-danger"><small> - @lang('Required')</small></span></label><br>
                          No <input class="" type="radio" name="hide_price" {{ ($addon != null) ? ($addon->hide_price==0?'checked':'') : 'checked' }} value="0"><br>
                          Yes <input class="" type="radio" name="hide_price" {{ ($addon != null) ? ($addon->hide_price==1?'checked':'') : '' }} value="1">
                        </div>
                        <div class="form-group">
                          <label for="required">Required Or Not<span class="text-danger"><small> - @lang('Required')</small></span></label><br>
                          No <input class="" type="radio" name="required_field" {{ ($addon != null) ? ($addon->required_field==0?'checked':'') : 'checked' }} value="0"><br>
                          Yes <input class="" type="radio" name="required_field" {{ ($addon != null) ? ($addon->required_field==1?'checked':'') : '' }} value="1">
                        </div>
                        @if($addon == null)
                            <label class="text-warning"><strong>Please Note: </strong>The below options will not be editable, so choose wisely. If you wish to change them you will need to create a new product addon.</label>
                            <div class="form-group">
                                <label for="item_id">Addon Type<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <select class="form-control type-select" id="type" name="type">
                                    <option>Text Input</option>
                                    <option>Number Input</option>
                                    <option>Checkbox</option>
                                    <option>Radio Options</option>
                                    <option>Drop Down</option>
                                </select>
                            </div>
                            <div class="form-group optionAmountDiv d-none">
                                <label for="radioOptionAmount">Amount Of Options<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <br>
                                <small class="text-info">You are allowed up to 5 options here.</small>
                                <input class="form-control" type="number" min="0" max="5" name="radioOptionAmount" id="radioOptionAmount" placeholder="Please Enter The Amount Of Options You Want">
                            </div>
                            <div class="optionCreationDiv d-none">

                            </div>

                            <div class="form-group optionAmountdropdownDiv d-none">
                                <label for="ddOptionAmount">Amount Of Options<span class="text-danger"><small> - @lang('Required')</small></span></label>
                                <br>
                                <!-- <small class="text-info">You are allowed up to 10 options here.</small> -->
                                  <input class="form-control" type="number" min="0" max="100000" name="ddOptionAmount" id="ddOptionAmount" placeholder="Please Enter The Amount Of Options You Want">
                            </div>
                            <div class="optionCreationdropdownDiv d-none">

                            </div>

                            <label class="text-info">Type Information</label>
                            <div class="typeInfo mb-2">
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="submitButton btn btn-outline-success">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@include('dashboard.layouts.scripts')
<script>
    $(function () {
        $('.type-select').on('change', function () {
            var option = $(this).val();
            var infoText = $('.typeInfo');
            if (option == "Text Input") {
                infoText.html(`<p>This will be a simple input where users can enter letters, numbers and symbols.<br><span class="text-secondary">Example:</span></p>
                                <input class="form-control" type="text" placeholder="Text Input">`);
                handleOptions();
            }
            if (option == "Number Input") {
                infoText.html(`<p>This will be a simple input where users can enter numbers from 0 and above.<br><span class="text-secondary">Example:</span></p>
                                <input class="form-control" type="number" min="0" placeholder="Number Input">`);
                handleOptions();
            }
            if (option == "Checkbox") {
                infoText.html(`<p>This will be a simple checkbox for the user to either check or not check. By default, it will be unchecked.<br><span class="text-secondary">Example:</span></p>
                                                        <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Option
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            `);
                handleOptions();
            }
            if (option == "Radio Options") {
                infoText.html(`<p>This will be a group of options whereby a user can only choose one option.<br><span class="text-secondary">Example:</span></p>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" >
                                        <span class="form-check-sign"></span>
                                        Option 1
                                    </label>
                                </div>
                                 <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" >
                                        <span class="form-check-sign"></span>
                                        Option 2
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" checked>
                                        <span class="form-check-sign"></span>
                                        Option 3
                                    </label>
                                </div>
                                `);
                handleOptions(true);
            }
            if (option == "Drop Down") {
                infoText.html(`<p>This will be a group of options whereby a user can only choose one option.<br><span class="text-secondary">Example:</span></p>
                                <div class="form-group">
                                  <select name="exampledropdown" class="form-control">
                                    <option>Select Option</option>
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                  </select>
                                </div>
                                `);
                handleOptions("dropdown");
            }
        }).trigger('change');

        function handleOptions(selected = false) {
            if (selected == true) {
                $('.optionAmountDiv').removeClass('d-none');
                $('.optionCreationDiv').removeClass('d-none');
                $(".optionAmountdropdownDiv").addClass("d-none");
                $(".optionCreationdropdownDiv").addClass("d-none");
            } else if(selected=="dropdown"){
              $('.optionCreationDiv').addClass('d-none');
              $('.optionAmountDiv').addClass('d-none');
              $(".optionAmountdropdownDiv").removeClass("d-none");
              $(".optionCreationdropdownDiv").removeClass("d-none");
            }
             else {
                $('.optionCreationDiv').addClass('d-none');
                $('.optionAmountDiv').addClass('d-none');
                $(".optionAmountdropdownDiv").addClass("d-none");
                $(".optionCreationdropdownDiv").removeClass("d-none");
            }
        }

        function addRadioOption(number) {
            $('.optionCreationDiv').append(`<input class="form-control" name="option-${number}" type="text" placeholder="Enter The Option Value" required><br>`)
        }

        function adddropdownOption(number) {
            $('.optionCreationdropdownDiv').append(`<div class="row mt-2"><div class="col-md-6"><input class="form-control" name="ddoption-${number}" type="text" placeholder="Enter The Option Name" required></div><div class='col-md-6'><input class="form-control" name="ddvalue-${number}" type="text" placeholder="Enter The Option Value" required></div></div>`)
        }

        $('#radioOptionAmount').on('keyup', function () {
            $('.optionCreationDiv').empty();
            let optionAmount = $(this).val();
            if (optionAmount > 5) {
                optionAmount = 5;
            }
            for (var i = 0; i < optionAmount; i++) {
                addRadioOption(i + 1);
            }
        });

        $('#ddOptionAmount').on('keyup', function () {
            $('.optionCreationdropdownDiv').empty();
            let optionAmount = $(this).val();
            // if (optionAmount > 10) {
            //     optionAmount = 10;
            // }
            for (var i = 0; i < optionAmount; i++) {
                adddropdownOption(i + 1);
            }
        });
    });
</script>
</html>
