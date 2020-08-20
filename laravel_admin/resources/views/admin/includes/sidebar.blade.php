<!-- Left side column. contains the logo and sidebar -->
@foreach($items as $item)
    <li class="{{ ($item->hasChildren() && $item->data('openable')) ? 'treeview' : '' }} {{ $item->attr("class") }}">
        <a href="{{ $item->url() }}">
            {!! $item->title !!}
            @if($item->hasChildren() && $item->data('openable'))
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
        </a>
        @if($item->hasChildren() && $item->data('openable'))
            <ul class="treeview-menu">
                @include('admin.includes.sidebar', array('items' => $item->children(), 'level' => 'third'))
            </ul>
        @endif
    </li>
@endforeach