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
            outline: none;
        }
        div#alert {
            color: red;
        }
        .flex-col {
            flex-direction: column;
        }
    </style>
@endsection

@section('main')
    <div class="flex flex-col">
        <form id="short-url-form">
            <div>
                <label for="link">Адрес</label>
                <input id="link" type="url" placeholder="https://example.com/" maxlength="512"/>
            </div>
            <button type="submit">Сократить!</button>
        </form>
        <div id="alert"></div>
    </div>
@endsection

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            document.querySelector('#short-url-form').addEventListener('submit', async(e) => {
                e.preventDefault()
                let response = await axios.post('/short', {
                    url: document.querySelector('#link').value
                })
                if (response.data.status === 'success') {
                    alert(`Ваша короткая ссылка: ${window.location.href}${response.data.shortLink}`)
                }
                if (response.data.status === 'error') {
                    response.data.errors.url.forEach(str => {
                        document.querySelector('#alert').innerHTML += `<p>${str}</p>`
                    });
                }
            })
        });
    </script>
@endsection