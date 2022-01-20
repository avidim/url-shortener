@extends('welcome')

@section('styles')
    <style>
        button[type="submit"] {
            width: 100%;
            height: 30px;
            cursor: pointer;
            margin-top: 10px;
        }
        input#link {
            padding: 5px;
            outline: none
        }
    </style>
@endsection

@section('main')
    <form id="short-url-form">
        <div>
            <label for="link">Адрес</label>
            <input id="link" type="url" placeholder="https://example.com/" required/>
        </div>
        <button type="submit">Сократить!</button>
    </form>
@endsection

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', async() => {
            document.querySelector('#short-url-form').addEventListener('submit', e => {
                e.preventDefault()
            })
        });
    </script>
@endsection