@extends('layouts.main')
@section('title','Root/'.implode('/',$pathArr))
@section('content')
    @if (!blank($head))
        <div class="card border-light mb-3">
            <div class="card-header">HEAD</div>
            <div class="card-body markdown-body">
                {!! $head !!}
            </div>
        </div>
    @endif
    <div class="card border-light mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    File
                </div>
                <div class="col d-none d-md-block d-md-none">
                    <span class="pull-right">LastModifiedDateTime</span>
                </div>
                <div class="col d-none d-md-block d-md-none">
                    <span class="pull-right">Size</span>
                </div>
                <div class="col">
                    <span class="pull-right">Action</span>
                </div>
            </div>
        </div>
        <div class="list-group">
            @if(!blank($pathArr))
                <li class="list-group-item list-group-item-action" style="border:0;"><a href="{{ route('dir',\App\Helpers\Tool::getParentUrl($pathArr)) }}"><i class="fa fa-arrow-left"></i> 返回上一层</a></li>
            @endif
            @foreach($items as $item)
                <li class="list-group-item list-group-item-action" style="border:0;">
                    <div class="row">
                        <div class="col">
                            @if($item['folder'])
                                <a href="{{ route('dir',$path ? $path.'-'.$item['name'] : $item['name']) }}" title="{{ $item['name'] }}">
                                    <i class="fa fa-folder"></i> {{ \App\Helpers\Tool::subStr($item['name'],0,20) }}
                                </a>
                            @else
                                <a href="{{ route('show',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}" title="{{ $item['name'] }}">
                                    <i class="fa {{\App\Helpers\Tool::getExtIcon($item['ext'])}}"></i>  {{ \App\Helpers\Tool::subStr($item['name'],0,20) }}
                                </a>
                            @endif
                        </div>
                        <div class="col d-none d-md-block d-md-none">
                            <span class="pull-right">{{ date('Y-m-d H:i:s',$item['lastModifiedDateTime']) }}</span>
                        </div>
                        <div class="col d-none d-md-block d-md-none">
                            <span class="pull-right">{{ \App\Helpers\Tool::convertSize($item['size']) }}</span>
                        </div>
                        <div class="col">
                            <span class="pull-right">
                                @if($item['folder'])
                                    <a href="javascript:void(0)" data-clipboard-text="{{ route('dir',$path ? $path.'-'.$item['name'] : $item['name']) }}" class="clipboard" title="已复制" data-toggle="tooltip"
                                       data-placement="right" ><i class="fa fa-clipboard"></i></a>&nbsp;&nbsp;
                                @elseif(in_array($item['ext'],['bmp','jpg','jpeg','png','gif']))
                                    <a href="{{ route('file',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}" class="fancybox" title="{{ $item['name'] }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                    <a href="{{ route('file',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}" title="下载"><i class="fa fa-download"></i></a>&nbsp;&nbsp;
                                    <a href="javascript:void(0)" data-clipboard-text="{{ route('file',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}" class="clipboard" title="已复制" data-toggle="tooltip"
                                       data-placement="right" ><i class="fa fa-clipboard"></i></a>&nbsp;&nbsp;
                                 @else
                                    <a href="{{ route('file',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}"><i class="fa fa-download" title="下载"></i></a>&nbsp;&nbsp;
                                    <a href="javascript:void(0)" data-clipboard-text="{{ route('file',$path ? $path.'/'.$item['name'] : 'root/'.$item['name']) }}" class="clipboard" title="已复制" data-toggle="tooltip"
                                       data-placement="right" ><i class="fa fa-clipboard"></i></a>&nbsp;&nbsp;
                                @endif
                            </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </div>
    </div>
    @if (!blank($readme))
        <div class="card border-light mb-3">
            <div class="card-header">README</div>
            <div class="card-body markdown-body">
                {!! $readme !!}
            </div>
        </div>
    @endif
@stop
