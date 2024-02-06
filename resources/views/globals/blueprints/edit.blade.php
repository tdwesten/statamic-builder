@extends('statamic::layout')
@section('title', __('Configure Global'))

@section('content')
    <div class="widgets @container flex flex-wrap -mx-4 py-2">
        <div class="widget w-full md:w-full mb-8 px-4">
            <div class="card p-0 content">
                <div class="py-6 px-8 border-b">
                    <h1>Blueprint not editable</h1>
                    <p>This blueprint is not editable because it's created by the Statamic Builder addon. If you want to
                        make changes to this blueprint, you can do so by editing the blueprint file directly.</p>
                </div>
            </div>
        </div>
    </div>
@stop
