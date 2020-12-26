<script src="{{asset('js/semantic.min.js')}}"></script>

<script>
    $(document).ready(function() {
        
        $('.ui.dropdown').dropdown(); //Semantic UI Dropdown

        // $('.search_input').hide(); //Hide Search Box

        $('.account.icon').click(function(e) {
            e.preventDefault();
            $('.account.modal').modal({
                onVisible: function() {
                    $(this).find('form').submit(function() {
                        $(this).find('.button[type="submit"]').addClass('loading');
                    });
                }
            }).modal('show');
        }); //Show Login Modal


        $('.ui.search.item').click(function(e) {
            event.preventDefault();
            $(this).hide().parents('.column').siblings('.ten.column').find('.cu').hide();
            $('.search_input').toggle('slide').find('input').focus(); //Show Search Box
        });

        $('.search_input').find('input').on('blur', function() {
            $('.search_input').toggle('slide');
            $('.ui.search.item').show('slow');
            $(this).parents('.column').siblings('.ten.column').find('.cu').show();
            // .siblings('.five.column').removeClass('five wide').addClass('four wide');
        });
        
        

        $('.sidebar_on').click(function() {
            $('.ui.sidebar').sidebar('setting', 'transition', 'overlay')
            .sidebar('toggle');
        });

        $('.sidebar_off').click(function() {
            $('.ui.sidebar').sidebar('toggle');
        })

        $('.dropdown_item').click(function() {
            $(this).find('i.icon').toggleClass('left').toggleClass('down');
        });

        $('.ui.accordion').accordion();

        $('.logout_button').click(function() {
            $('#logout-form').submit();
        });

        @if(Session::has('success'))
            $('body')
                .toast({
                    class: 'success',
                    displayTime: 5000,
                    message: `{{Session::get('success')}}`
                })
            ;
        @endif
        
        @if(!empty($message))
        $('body')
            .toast({
                class: 'success',
                displayTime: 5000,
                message: `{{ $message }}`
            })
        ;
        @endif

        // @error('email')
        //     $('body')
        //         .toast({
        //             class: 'error',
        //             displayTime: 5000,
        //             message: `Login Failed`
        //         })
        //     ;
        // @enderror

        @if(Session::has('error'))
            $('body')
                .toast({
                    class: 'error',
                    displayTime: 5000,
                    message: `{{Session::get('error')}}`
                })
            ;
        @endif
        

        var size = $(window).width();
        if(size < 992) {
            $('.inverted.stackable.menu').removeClass('compact');
            $('.social_icon.menu').removeClass('right floated');
            $('.item').removeClass('nav_border_l');
            // $('.ui.icon.blue.login.button').addClass('large').children('span').text('Facebook');
            // $('.ui.icon.red.login.button').addClass('large').children('span').text('Google');
            $('.footer.grid').addClass('center aligned').find('form').removeClass('pr-50').addClass('px-20');
            $('.footer.grid').find('.divider').removeAttr('hidden').addClass('mb-20');

            $('.post_show_main').find('.fluid.button').removeClass('large').addClass('small')
            .parents().siblings().find('.right.floated.header').addClass('small');
            $('.post_show_latest').find('.card').removeClass('horizontal')
            .children('.image').removeClass('w-30').siblings('.content').find('.icon').hide();

            $('*').popup('hide all').removeAttr('data-tooltip');

            @yield('custom_window_width_script')
        } else {
            
            @yield('custom_window_width_else_script')
        }

        $(window).resize(function() {
            var size = $(window).width();
            if(size >= 992) {
                $('.inverted.stackable.menu').addClass('compact')
                .children('.item').not('.home').addClass('nav_border_l');
                $('.social_icon.menu').addClass('right floated');
                // $('.ui.icon.blue.login.button').removeClass('large').children('span').text('Login with Facebook');
                // $('.ui.icon.red.login.button').removeClass('large').children('span').text('Login with Google');
                $('.footer.grid').removeClass('center aligned').find('form').removeClass('px-20').addClass('pr-50');
                $('.footer.grid').find('.divider').attr('hidden','1').removeClass('mb-20');

                $('.post_show_main').find('.fluid.button').removeClass('small').addClass('large')
                .parents().siblings().find('.right.floated.header').removeClass('small');
                $('.post_show_latest').find('.card').addClass('horizontal')
                .children('.image').addClass('w-30').siblings('.content').find('.icon').show();

                @yield('custom_resize_if_script')

            } else {
                $('.inverted.stackable.menu').removeClass('compact');
                $('.item').removeClass('nav_border_l');
                $('.social_icon.menu').removeClass('right floated');
                // $('.ui.icon.blue.login.button').addClass('large').children('span').text('Facebook');
                // $('.ui.icon.red.login.button').addClass('large').children('span').text('Google');
                $('.footer.grid').addClass('center aligned').find('form').removeClass('pr-50').addClass('px-20');
                $('.footer.grid').find('.divider').removeAttr('hidden').addClass('mb-20');
                
                $('.post_show_main').find('.fluid.button').removeClass('large').addClass('small')
                .parents().siblings().find('.right.floated.header').addClass('small');
                $('.post_show_latest').find('.card').removeClass('horizontal')
                .children('.image').removeClass('w-30').siblings('.content').find('.icon').hide();

                $('*').popup('hide all').removeAttr('data-tooltip');

                @yield('custom_resize_else_script')


            }

            


            
        });

        $('.message .close')
            .on('click', function() {
                $(this)
                .closest('.message')
                .transition('fade')
                ;
            })
        ;
        $('input,i,span').popup({
            inline: true
        });

        // $('.content_item, .dropdown_item, .drop_item').dblclick(function(e) {
        //     return false;
        //     e.preventDefault();
            
        //     alert('boy');
        // });

        @yield('custom_script')

        

    });
</script>


