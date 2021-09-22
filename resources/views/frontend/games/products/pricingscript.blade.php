<script>
    $(function () {
        $('input[type="range"]').rangeslider({
            polyfill : false,
            onInit : function() {
                this.output = $('.matchesAmount').html( this.$element.val() );
            },
            onSlide : function( position, value ) {
                this.output.html( value );
            }
        });
        //Password Specific
        var passwordShowing = false;
        $("#passwordView").on('click', function () {
                if (passwordShowing !== true) {
                    $('#password').get(0).type = 'password';
                    passwordShowing = true;
                } else {
                    passwordShowing = false;
                    $('#password').get(0).type = 'text';
                }
            }
        );
        //Platform Selection
        $('#platform').on('change', function () {
            if ($(this).val() == "PC") {
                $('.platform_email').html('@lang('Account Email?'):');
                $('.platform_username').html('@lang('Account Username?'):');
                $('.platform_password').html('@lang('Account Password?'):');
            }
            if ($(this).val() == "XBOX") {
                $('.platform_email').html('@lang('XBOX Email?'):');
                $('.platform_username').html('@lang('XBOX Username?'):');
                $('.platform_password').html('@lang('XBOX Password?'):');
            }
            if ($(this).val() == "Playstation") {
                $('.platform_email').html('@lang('Playstation Email?'):');
                $('.platform_username').html('@lang('Playstation Username?'):');
                $('.platform_password').html('@lang('Playstation Password?'):');
            }
        }).trigger('change');

        //Calculator Logic
        function resetAddons() {
            $('.optionCheckbox').prop('checked', false);
            $('.optionTextInput').val('');
            $('.optionTextInput').removeClass('text-entered');
            $('.optionNumberInput').val('');
            $('.optionNumberInput').removeClass('number-entered');
            $('.optionRadioButton').prop('checked', false).removeClass('isClicked notClicked')
            $('#platform_email').prop('disabled', false).val('').prop('required', true).css('opacity', 1);
            $('#password').prop('disabled', false).val('').prop('required', true).css('opacity', 1);
        }

        //Define our checkboxes function
        function handleCheckboxes(boosting = false, checkbox) {
            if (boosting) {
                checkbox.attr('data-original-price', parseFloat(boostingPrice)); //Assign our data attribute the current boosting price
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = checkbox.data('price');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = checkbox.data('price');
                var priceToAdd = (pricePercent / 100) * {{ $product->price }};
            }
            if (checkbox.prop('checked')) {
                if (boosting) {
                    boostPrice += priceToAdd;
                    handlePricing(boostPrice);
                } else {

                    price += priceToAdd;
                    handlePricing(price);
                }
            } else {
                if (boosting) {
                    var originalPrice = checkbox.data('original-price');
                    var newPrice = boostPrice - priceToAdd;
                    boostPrice -= newPrice;
                    handlePricing(newPrice);
                } else {
                    price -= priceToAdd;
                    handlePricing(price);
                }

            }
        }

        //Define our text inputs function
        function handleTextInput(boosting = false, inputField, event) {
            if (boosting) {
                inputField.attr('data-original-price', parseFloat(boostingPrice)); //Assign our data attribute the current boosting price
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = inputField.data('price');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = inputField.data('price');
                var priceToAdd = (pricePercent / 100) * {{ $product->price }};
            }
                if (inputField.val().length > 0) { //If we're entering something
                    if (!inputField.hasClass('text-entered')) { //If we haven't already got text inside the box(this is to stop adding prices when we edit our value)
                        if (boosting) {
                            boostPrice += priceToAdd;
                            handlePricing(boostPrice);
                        } else {
                            price += priceToAdd;
                            handlePricing(price);
                        }
                        inputField.addClass('text-entered'); //Add our text-entered class so we know we've already entered text into this input
                    }
                } else { //If our box is empty
                    inputField.removeClass('text-entered'); //Remove our class so we know the box is empty
                    if (boosting) {
                        var originalPrice = inputField.data('original-price');
                        var newPrice = boostPrice - priceToAdd;
                        boostPrice -= newPrice;
                        handlePricing(newPrice);
                    } else {
                        price -= priceToAdd;
                        handlePricing(price);
                    }
                }
        }

        //Define our number inputs function
        function handleNumberInput(boosting = false, numberField, event) {
            if (boosting) {
                numberField.attr('data-original-price', parseFloat(boostingPrice)); //Assign our data attribute the current boosting price
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = numberField.data('price');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = numberField.data('price');
                var priceToAdd = (pricePercent / 100) *{{ $product->price }};
            }
            if (!isNaN(numberField.val()) && numberField.val().length > 0) { //If we've entered a number
                if (!numberField.hasClass('number-entered')) {
                    numberField.addClass('number-entered');
                    if (boosting) {
                        boostPrice += priceToAdd;
                        handlePricing(boostPrice);
                    } else {
                        price += priceToAdd;
                        handlePricing(price);
                    }
                }
            } else {
                if (boosting) {
                    var originalPrice = numberField.data('original-price');
                    var newPrice = boostPrice - priceToAdd;
                    boostPrice -= newPrice;
                    handlePricing(newPrice);
                } else {
                    price -= priceToAdd;
                    handlePricing(price);
                }
                numberField.removeClass('number-entered');
            }
        }

        //Define dropdown Options
        function handleddfields(boosting = false, dropdown){

        	if (boosting) {
                $('option:selected', dropdown).attr('data-original-price',parseFloat(boostingPrice));                
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = $('option:selected', dropdown).attr('data-amount');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = $('option:selected', dropdown).attr('data-amount');
                var priceToAdd = (pricePercent / 100) *{{ $product->price }};
            }
          //ddprice current price
          //dd_price old price
          // var ddprice = $('option:selected', dropdown).attr('data-amount');
          var dd_id = dropdown.attr("id");

          // if(ddprice.indexOf("-") && {{$product->price}}=="0") return false;

          var dd_price = $(".dd_"+dd_id).val();


          if (boosting) {
          				boostPrice -= dd_price;
                        boostPrice += priceToAdd;
                        $(".dd_"+dd_id).val(priceToAdd);          				
                        handlePricing(boostPrice);
                    } else {
                    	price -= dd_price;
                        price += priceToAdd;
                        $(".dd_"+dd_id).val(priceToAdd);          				
                        handlePricing(price);

                    }

        }
        //Define our radio options function
        function handleRadioOptions(boosting = false, radioOption) {
            if (boosting) {
                radioOption.attr('data-original-price', parseFloat(boostingPrice)); //Assign our data attribute the current boosting price
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = radioOption.data('price');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = radioOption.data('price'); //Get the percentage of the price from the button
                var priceToAdd = (pricePercent / 100) *{{ $product->price }}; //calculate the percent to take off
            }
            var resetOptionsButton = radioOption.parent().siblings().find('.resetButton');
            var otherRadios = radioOption.parent().siblings().find('.optionRadioButton');
            var alreadyClicked = false;
            otherRadios.each(function (index) {
                if ($(this).hasClass('isClicked')) {
                    alreadyClicked = true;
                }
                $(this).removeClass('isClicked');
                $(this).addClass('notClicked')
            });
            radioOption.removeClass('notClicked');
            radioOption.addClass('isClicked');
            if (alreadyClicked === false) {
                if (boosting) {
                    boostPrice += priceToAdd;
                    handlePricing(boostPrice);
                } else {
                    price += priceToAdd; //Add on the percentage
                    handlePricing(price); //Update the price
                }
                resetOptionsButton.removeClass('disabled').removeProp('disabled')
            }
        }

        //Define our reset button for radio options
        function handleRadioButtonResetOption(boosting = false, resetButton) {
            if (boosting) {
                resetButton.attr('data-original-price', parseFloat(boostingPrice)); //Assign our data attribute the current boosting price
                var boostPrice = parseFloat($('.price').text());
                var pricePercent = resetButton.data('price');
                var priceToAdd = (pricePercent / 100) * boostingPrice;
            } else {
                var pricePercent = resetButton.data('price');
                var priceToAdd = (pricePercent / 100) *{{ $product->price }};
            }
            var otherRadiosChecked = false;
            var otherRadios = resetButton.parent().siblings().find('.optionRadioButton');
            otherRadios.each(function (index) {
                if ($(this).is(':checked')) {
                    $(this).prop('checked', false);
                }
                $(this).addClass('notClicked');
                $(this).removeClass('isClicked');
            });
            if (boosting) {
                var originalPrice = resetButton.data('original-price');
                var newPrice = boostPrice - priceToAdd;
                boostPrice -= newPrice;
                handlePricing(newPrice);
            } else {
                price -= priceToAdd;
                handlePricing(price);
                resetButton.addClass('disabled').prop('disabled');
            }
        }

        //Non Boosting Products
                @if($boostSchemes == null && $product->type != 'Placement'  && $product->type != "Rank")
        var price = {{ $product->price }}; //For boosting this will be 0 but nbd if they start at 0, we'll just check for it in the backend
                @else
        var boostingPrice = 0;        
        @endif


        //Checkboxes
        $('.optionCheckbox').on('click', function () {
            @if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
                handleCheckboxes(true, $(this));
            @else
                handleCheckboxes(false, $(this));
            @endif
            if ($(this).hasClass('duoq')) {
                if ($(this).prop('checked')) {
                    $('#platform_email').prop('disabled', true).val('').prop('required', false).css('opacity', 0.5);
                    $('#password').prop('disabled', true).val('').prop('required', false).css('opacity', 0.5);
                } else {
                    $('#platform_email').prop('disabled', false).val('').prop('required', true).css('opacity', 1);
                    $('#password').prop('disabled', false).val('').prop('required', true).css('opacity', 1);
                }
            }
        });

        $('.optionTextInput').on('keyup', function (e) {
            @if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
            handleTextInput(true, $(this), e);
            @else
            handleTextInput(false, $(this), e);
            @endif
        });

        $('.optionNumberInput').on('change keyup', function (e) {
            @if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
            handleNumberInput(true, $(this), e);
            @else
            handleNumberInput(false, $(this), e);
            @endif
        });

        $('.optionRadioButton').on('change', function () { //When we change a radio button
            @if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
            handleRadioOptions(true, $(this));
            @else
            handleRadioOptions(false, $(this));
            @endif
        });

        $('.dropdownfield').on('change', function () { //When we change a radio button
        	@if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
            handleddfields(true,$(this));
            @else
            handleddfields(false, $(this));
            @endif
            
        });

        $('.resetButton').on('click', function () {
            @if($boostSchemes != null || $product->type == 'Placement' || $product->type == 'Rank' )
            handleRadioButtonResetOption(true, $(this));
            @else
            handleRadioButtonResetOption(false, $(this));
            @endif
        });
        @if($boostSchemes == null && $product->type != 'Placement' && $product->type!="Rank")
        handlePricing(price);
        @else
        handlePricing(boostingPrice)
        @endif
        function handlePricing(price) {
            @if($boostSchemes !== null || $product->type == 'Placement' || $product->type == 'Rank' )
                inputPricePercents = $('.productPriceLabelTotal');
            inputPricePercents.each(function (index) {
                var percentage = $(this).siblings().first().text();
                $(this).text(((boostingPrice / 100) * percentage).toFixed(2));
            });
            $('.productPriceLabel').text(boostingPrice.toFixed(2));
            @endif
            $('.price').html(price.toFixed(2));
        }

        //Boosting Exclusive
        function updateCurrentLevelDisplay(start_range, extension) {
            $('.start-image-holder').attr('src', '{{ asset('dash/images/boosting/product') }}/{{ $product->id }}/startrange/' + start_range + extension);
        }

        function updateDesiredLevelDisplay(end_range, extension) {
            $('.end-image-holder').attr('src', '{{ asset('dash/images/boosting/product') }}/{{ $product->id }}/endrange/' + end_range + extension);
        }

        var totalAmountVariable = null;
        $('.placementSelect').on('change', function () {
            handlePlacementPricing();
        }).trigger('change');
        $('#match-amount').on('input', function() {
            handlePlacementPricing();
        });
        function handlePlacementPricing() {
                var selectedOptionPrice = $('.placementSelect').find(":selected").data('price');
                boostingPrice = (selectedOptionPrice * $('#match-amount').val());
                handlePricing(boostingPrice);
                resetAddons();
                if($('.placementSelect').find(":selected").data('extension') != ""){
                $('.placement-image-container').html('<img src="{{ asset('dash/images/placement/product') }}/{{ $product->id }}/' + $('.placementSelect').find(":selected").val() + $('.placementSelect').find(":selected").data('extension') + '" style="height:120px;">')
              }
        }
        @if($boostSchemes != null)
        function handleBoosts() {
            if (totalAmountVariable != null) {
                price -= totalAmountVariable;
                handlePricing(price);
                totalAmountVariable = null;
            }
            var prices = [];
            var desiredLevel = parseInt($('#boostRangeDesired').val());
            var currentLevel = parseInt($('#boostRangeCurrent').val());
            if ($.isNumeric(desiredLevel) && $.isNumeric(currentLevel)) { //So firstly make sure we've got numbers in both boxes
                if (desiredLevel > currentLevel) { //Make sure our desired level is higher than our current level
                    @foreach($boostSchemes as $scheme) //Loop through all our boost schemes for this product and put them in our aray
                    prices[{{ $scheme->id }}] = [{{$scheme->price_per_level}}];
                    prices[{{ $scheme->id }}][{{$scheme->price_per_level}}] = [
                        {{ $scheme->start_range }}, {{ $scheme->end_range }}
                    ];
                    prices[{{ $scheme->id }}]['startExtension'] = '{{ $scheme->start_image }}';
                    prices[{{ $scheme->id }}]['endExtension'] = '{{ $scheme->end_image }}';
                            @endforeach
                    var counter = 0; //Counter to calculate the price up until the level that we've selected. For example if we're crossing through 3 level boundaries and need to calculate the previous ones
                    var skippedRangesCounter = 0;
                    var sameLevelPrice = 0;
                    var lowerLevelInRangePrice = 0;
                    var higherLevelInRangePrice = 0;
                    prices.forEach(function (item, index) {
                        var pricePerLevel = item[0];
                        var lowerLevelBoundary = item[pricePerLevel][0];
                        var higherLevelBoundary = item[pricePerLevel][1];
                        var ID = item;
                        //If both our levels are in the same range
                        if (currentLevel >= lowerLevelBoundary && desiredLevel <= higherLevelBoundary) {
                            sameLevelPrice = (desiredLevel - currentLevel) * pricePerLevel;
                            updateCurrentLevelDisplay(lowerLevelBoundary, item['startExtension']);
                            updateDesiredLevelDisplay(higherLevelBoundary, item['endExtension']);
                            handlePricing(sameLevelPrice);
                            boostingPrice = sameLevelPrice;
                            resetAddons();
                        } else {
                            if (desiredLevel > higherLevelBoundary && currentLevel < lowerLevelBoundary) {
                                skippedRangesCounter += pricePerLevel * (higherLevelBoundary - lowerLevelBoundary);
                            } else {
                                if (currentLevel >= lowerLevelBoundary && currentLevel <= higherLevelBoundary) {
                                    updateCurrentLevelDisplay(lowerLevelBoundary, item['startExtension']);
                                    lowerLevelInRangePrice = (higherLevelBoundary - currentLevel) * pricePerLevel;
                                }
                                if (desiredLevel >= lowerLevelBoundary && desiredLevel <= higherLevelBoundary) {
                                    updateDesiredLevelDisplay(higherLevelBoundary, item['endExtension']);
                                    higherLevelInRangePrice = (desiredLevel - lowerLevelBoundary) * pricePerLevel;
                                }
                            }
                            var finalNumber = 0;
                            finalNumber = lowerLevelInRangePrice + higherLevelInRangePrice + skippedRangesCounter;
                            if (finalNumber !== 0) {
                                handlePricing(finalNumber);
                                boostingPrice = finalNumber;
                                resetAddons();
                            }
                        }
                    });
                } else {
                    handlePricing(0);
                }
            }
        };
        $('#boostRangeDesired').on('change keyup', function () {
            handleBoosts();
        });
        $('#boostRangeCurrent').on('change keyup', function () {
            handleBoosts();
        });

        @endif

        $(".get_price").on("change",function(){
            get_rank_price();
        });

        $(".level_change").on('change',function(){
          current_val = $(this).find('option:selected').text();
          target = $(this).data("target");
          image_div = $(this).data("image");
          $.ajax({
            type: "GET",
            url: "<?php echo url('api/games/get_level_via_rankname') ?>",
            data: {'current_val': current_val ,'product_id':{{$product->id}}, '_token': '{{csrf_token()}}'},
            success: function(data){
              if(data!='No data'){
                $('.'+target).css("display","block");
                $('.'+target).find('option').remove();

                $.each(data, function(key, value) {

                  $('.'+target).append($("<option></option>")
                      .attr("value", value.id)
                      .text(value.level));


                    });

              }else{
                $('.'+target).find('option').remove();
                $('.'+target).css("display","none");
              }

              get_rank_price();

            },
            error:function(){
              console.log("Sorry,some error occurred");
            }
          });
        });


        function get_rank_price(){
          /////////////price setting//////////////////

          var real_rank_amount = $(".real_rank_amount").val();
          // if(typeof(price)==="undefined"){
          //     boostingPrice -= real_rank_amount;
          // }else{
          //     price -= real_rank_amount;
          // }
          boostingPrice -= real_rank_amount;
          var current_id = $(".current_rank_name").val();
          var current_level = $(".current_rank_level").val();
          var desired_id = $(".desired_rank_name").val();
          var desired_level = $(".desired_rank_level").val();

          if(current_level == null){
            start_rank = current_id;
          }else{
            start_rank = current_level;
          }

          if(desired_level == null){
            end_rank = desired_id;
          }else{
            end_rank = desired_level;
          }

          $.ajax({
            type: "GET",
            url: "<?php echo url('api/games/get_rank_price') ?>",
            data: {'start_rank': start_rank , 'end_rank':end_rank ,'_token': '{{csrf_token()}}'},
            success: function(data){
              if(data!='No data'){
              	boostingPrice += parseFloat(data.amount);
                // if(typeof(price)==="undefined"){
                //     boostingPrice += parseFloat(data.amount);
                // }else{
                //     price += parseFloat(data.amount);
                // }

                $(".real_rank_amount").val(data.amount);
                handlePricing(boostingPrice);
                // if(typeof(price)==="undefined"){
                //     handlePricing(boostingPrice);
                // }else{
                //     handlePricing(price);
                // }
                if(data.start_img != null){
                  $(".current_rank_image").html("<img src='{{ asset('dash/images/rank/')}}/{{$product->id}}/"+data.start_img+"'>");
                }else{
                  $(".current_rank_image").html("");
                }
                if(data.end_img != null){
                  $(".desired_rank_image").html("<img src='{{ asset('dash/images/rank/')}}/{{$product->id}}/"+data.end_img+"'>");
                }else{
                  $(".desired_rank_image").html("");
                }
              }else{

              }
            },
            error:function(){
              console.log("Sorry,some error occurred");
            }
          });
          //////////////price setting/////////////////
        }
    });


</script>
