<div class="mb-6">
    <div class="relative mb-4">
        <div class="hidden sm:flex rounded-lg overflow-hidden shadow-sm border border-gray-200 bg-gray-50">
            @foreach ($sections as $section)
                <button type="button" 
                    class="flex-1 flex items-center justify-center px-4 py-3 font-medium text-sm transition-all duration-300 ease-in-out
                           {{ $loop->first ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50 border-l border-gray-200 first:border-l-0' }}
                           section-btn"
                    id="{{ $section['id'] }}-btn" 
                    data-target="#{{ $section['id'] }}">
                    <i class="fas fa-{{ $section['icons'] }} mr-2"></i>
                    <span>{{ $section['title'] }}</span>
                </button>
            @endforeach
        </div>

        <div class="sm:hidden relative">
            <button id="mobile-tab-dropdown" class="w-full flex items-center justify-between px-4 py-3 bg-white border border-gray-300 rounded-lg shadow-sm text-gray-700 font-medium">
                <span class="flex items-center">
                    <i class="fas fa-{{ $sections[0]['icons'] }} mr-2 text-blue-600"></i>
                    <span>{{ $sections[0]['title'] }}</span>
                </span>
                <i class="fas fa-chevron-down ml-2 text-gray-500 transition-transform duration-200"></i>
            </button>
            
            <div id="mobile-tab-menu" class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg">
                @foreach ($sections as $section)
                    <button type="button" 
                        class="w-full text-left px-4 py-3 hover:bg-gray-50 flex items-center border-b border-gray-200 last:border-b-0 mobile-tab-btn"
                        data-target="#{{ $section['id'] }}">
                        <i class="fas fa-{{ $section['icons'] }} mr-2 text-blue-600"></i>
                        <span>{{ $section['title'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        @foreach ($sections as $section)
            <div id="{{ $section['id'] }}" class="section-content {{ $loop->first ? '' : 'hidden' }}">
                @include($section['view'], ['model' => $model])
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle desktop tab clicks
        $('.section-btn').on('click', function(e) {
            updateActiveTab($(this));
        });

        // Handle mobile tab selection
        $('.mobile-tab-btn').on('click', function() {
            // Update dropdown button
            const $dropdownBtn = $('#mobile-tab-dropdown');
            const $icon = $(this).find('i').clone();
            const $text = $(this).find('span').clone();
            
            $dropdownBtn.empty().append($icon).append($text)
                .append('<i class="fas fa-chevron-down ml-2 text-gray-500 transition-transform duration-200"></i>');
            
            // Close menu
            $('#mobile-tab-menu').addClass('hidden');
            
            // Update active tab
            updateActiveTab($(this));
        });

        // Toggle mobile menu
        $('#mobile-tab-dropdown').on('click', function() {
            const $menu = $('#mobile-tab-menu');
            const isHidden = $menu.hasClass('hidden');
            const $icon = $(this).find('.fa-chevron-down');
            
            $menu.toggleClass('hidden');
            $icon.toggleClass('rotate-180', !isHidden);
        });

        function updateActiveTab($activeButton) {
            // Update button styles (desktop)
            $('.section-btn')
                .removeClass('bg-blue-600 text-white')
                .addClass('bg-white text-gray-700 hover:bg-gray-50 border-l');
            
            if ($activeButton.hasClass('section-btn')) {
                $activeButton
                    .removeClass('bg-white text-gray-700 hover:bg-gray-50 border-l')
                    .addClass('bg-blue-600 text-white');
            }

            // Toggle section visibility
            const targetId = $activeButton.data('target');
            $('.section-content').addClass('hidden');
            $(targetId).removeClass('hidden');
        }
    });
</script>