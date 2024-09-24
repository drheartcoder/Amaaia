 <div class="bradcrum-inner">

    <div class="pul-left-title">
        @if(isset($sub_module_title) && !empty($sub_module_title))
            {{$sub_module_title or '' }}
        @else
        {{$module_title or '' }}
        @endif
    </div>
    <div class="pul-right-sublink">
        <a href="{{$parent_module_url or ''}}">
        	 {{$parent_module_title or ''}}
        </a> / 
        @if(isset($module_url) && !empty($module_url))
        	<a href="{{$module_url or ''}}">
        	 {{$module_title or ''}}
        	</a> /
        @else
        	<span>{{$module_title or '' }}</span>
        @endif

        @if(isset($sub_module_title) && !empty($sub_module_title))
        	<span>{{$sub_module_title or '' }}</span>
        @endif
        
    </div>

    <div class="clearfix"></div>
    
</div>