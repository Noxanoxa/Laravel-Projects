@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">{{__('Backend/settings.settings')}} </div>
                <ul class="list-group list-group-flush">
                    @foreach($settings_sections as $settings_section)
                        <li class="list-group-item">
                            <a href="{{ route('admin.settings.index', ['section' => $settings_section->section_en]) }}"
                               class="nav-link"><i class="fa fa-gear"></i> {{ $settings_section->section() }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">{{__('Backend/settings.settings')}} {{ config('app.locale') == 'ar' ? $settings[0]->section : $settings[0]->section_en }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update', 1) }}">
                        @csrf
                        @method('PATCH')
                        @foreach($settings as $setting)
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">{{ $setting->display_name() }}</label>
                                        @if ($setting->type == 'text')
                                            <input type="text" name="value[{{ $loop->index }}]" id="value"
                                                   class="form-control" value="{{ $setting->value() }}">
                                        @elseif($setting->type == 'textarea')
                                            <textarea name="value[{{ $loop->index }}]" id="value" class="form-control"
                                                      cols="30" rows="10">{{ $setting->value() }}</textarea>
                                        @elseif($setting->type == 'image')
                                            <input type="file" name="value[{{ $loop->index }}]" id="value"
                                                   class="form-control">
                                        @elseif($setting->type == 'select')

                                            <select name="value['{{ $loop->index }}']" id="value" class="form-control">
                                                @foreach(explode('|', $setting->details) as $detail)
                                                    <option
                                                        value="{{ $detail }}" {{ $setting->value() == $detail ? 'selected' : '' }}>{{ $detail }}</option>
                                                @endforeach
                                            </select>
                                        @elseif($setting->type == 'checkbox')
                                            <input type="checkbox" name="value[{{ $loop->index }}]" id="value"
                                                   class="styled" value="1" {{ $setting->value() == 1 ? true : false }}>
                                        @elseif($setting->type == 'radio')
                                            <input type="radio" name="value['{{ $loop->index }}']" id="value"
                                                   class="styled" value="1" {{ $setting->value() == 1 ? true : false }}>
                                        @endif

                                        <input type="hidden" name="key[{{ $loop->index }}]" id="key"
                                               class="form-control" value="{{ $setting->key }}" readonly>
                                        <input type="hidden" name="id[{{ $loop->index }}]" id="key" class="form-control"
                                               value="{{ $setting->id }}" readonly>
                                        <input type="hidden" name="ordering[{{ $loop->index }}]" id="key"
                                               class="form-control" value="{{ $setting->ordering }}" readonly>

                                        @error('value') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{__('Backend/settings.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
