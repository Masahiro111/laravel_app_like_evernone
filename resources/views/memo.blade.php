@extends('layouts.app')

@section('content')
<div class="h-100 bg-white">
    <div class="row h-100 m-0 p-0">
        <div class="col-3 h-100 m-0 p-0 border-left border-right border-gray">
            <div class="left-memo-menu d-flex justify-content-between pt-2">
                <div class="pl-3 pt-2">
                    {{ $name }}
                </div>
                <div class="pr-1">
                    <a href="{{ route('memo.add') }}" class="btn btn-success">
                        <i class="fas fa-plus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </i>
                    </a>
                    <a href="{{ route('memo.logout') }}" class="btn btn-dark">
                        <i class="fas fa-sign-out-alt">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </i>
                    </a>
                </div>
            </div>
            <div class="left-memo-title h3 pl-3 pt-3">
                メモリスト
            </div>
            <div class="left-memo-list list-group-flush p-0">
                @if ($memos->count() === 0)
                <div class="pl-3 pt-3 h5 text-info text-center">
                    <i class="far fa-surprise"></i>メモがありません。
                </div>
                @endif
                
                @foreach ($memos as $memo)
                <a href="{{ route('memo.select', ['id' => $memo->id]) }}" class="list-group-item list-group-item-action  @if ($select_memo) {{ $select_memo->id == $memo->id ? 'active' : '' }} @endif ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $memo->title }} </h5>
                        <small>{{ date('Y/m/d H:i', strtotime($memo->updated_at)) }}</small>
                    </div>
                    <p class="mb-1">
                        @if (mb_strlen($memo->content) <= 100)
                            {{ $memo->content }}
                        @else
                            {{ mb_substr($memo->content, 0, 100) . "..." }}
                        @endif
                    </p>
                </a>
                @endforeach

                

            </div>
        </div>
        <div class="col-9 h-100">
            @if ($select_memo)
            <form class="w-100 h-100" method="post">
                @csrf
                <input type="hidden" name="edit_id" value="{{ $select_memo->id }}" />
                <div id="memo-menu">
                    <button type="submit" class="btn btn-danger" formaction="{{ route('memo.delete') }}">
                        <i class="fas fa-trash-alt">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </i>
                    </button>
                    <button type="submit" class="btn btn-success" formaction="{{ route('memo.update') }}">
                        <i class="fas fa-save">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                        </i>
                    </button>
                </div>
                <input type="text" id="memo-title" name="edit_title" placeholder="タイトルを入力する..." value="{{ $select_memo->title }}" />
                <textarea id="memo-content" name="edit_content" placeholder="内容を入力する...">{{ $select_memo->content }}</textarea>
            </form>
            @else
            <div class="mt-3 alert alert-info">
                <i class="fas fa-info-circle"></i>メモを新規作成するか選択してください。
            </div>
            @endif
        </div>
    </div>
</div>
@endsection