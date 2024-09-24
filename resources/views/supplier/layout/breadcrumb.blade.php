<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="fa fa-angle-double-right"></i> 
        <span class="text-semibold">
          @if(isset($module_title) && !empty($module_title) && isset($sub_module_title) && !empty($sub_module_title))
            {{$module_title}}
              </span>
            {{isset($sub_module_title) ? '- '. $sub_module_title : ''}}
          @elseif(isset($module_title) && isset($parent_module_title))
               {{$parent_module_title or ''}}
              </span>
              {{isset($module_title) ? '- '. $module_title : ''}}
           @elseif(isset($parent_module_title))
              {{$parent_module_title or ''}}
          @endif
</h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li class="{{isset($module_title) && !empty($module_title) ? '' : 'active'}}">
          @if(isset($module_title) && !empty($module_title))
              <a href="{{isset($module_title) && isset($parent_module_url) ? $parent_module_url : 'javascript:void(0)'}}">
                <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
              </a>
          @else
              <i class="{{$parent_module_icon or ''}}"></i> {{$parent_module_title or ''}}
          @endif
      </li>
      @if(isset($module_title) && !empty($module_title))
          <li class="{{isset($sub_module_title) && !empty($sub_module_title) ? '' : 'active'}}">
              @if(isset($sub_module_title) && !empty($sub_module_title))
                  <a href="{{$module_url or 'javascript:void(0)'}}">
                      <i class="{{$module_icon or ''}}"> </i> {{$module_title or ''}}
                  </a>
              @else
                  <i class="{{$module_icon or ''}}"> </i> {{$module_title or ''}}
              @endif
          </li>
    @endif
      @if(isset($sub_module_title) &&  !empty($sub_module_title))
        <li class="active">
            <i class="{{$sub_module_icon or ''}}"> </i> {{$sub_module_title or ''}}
        </li>
      @endif
    </ul>
  </div>
</div>