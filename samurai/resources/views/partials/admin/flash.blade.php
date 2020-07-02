@if (@session('flash'))
    <div class="section-1">
        <div class="{{ @session('flash')['class'] }}">
            <span class="">{{ @session('flash')['mes'] }}</span>
        </div>
    </div>
@endif
