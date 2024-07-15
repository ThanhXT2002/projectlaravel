{{-- <div class="ibox-title">
    <h5 class="text-uppercase">{{$title}}</h5>
    <div class="ibox-tools">
        <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
        </a>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-wrench"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a class="changeStatusAll" data-value="2"  data-field ="status" data-model='' >Active toàn bộ</a>
            </li>
            <li><a class="changeStatusAll" data-value="1" data-field ="status" data-model='' >Unactive toàn bộ</a>
            </li>
        </ul>
        <a class="close-link">
            <i class="fa fa-times"></i>
        </a>
    </div>
</div> --}}

<div class="card-tools">
    <div class="btn-group">
        <button type="button" class="btn btn-tool  btn-sm " data-toggle="dropdown"
            data-offset="-52">
            <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-menu" role="menu">
            <a href="#" class="changeStatusAll dropdown-item" data-value="2" data-field="publish" data-model="{{  $config['model']  }}">{{ __('messages.toolboxActive') }}</a>
            <a href="#" class="changeStatusAll dropdown-item" data-value="1" data-field="publish" data-model="{{  $config['model']  }}">{{ __('messages.toolboxUnActive') }}</a>            
        </div>
    </div>
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
    </button>
    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
    </button>
</div>