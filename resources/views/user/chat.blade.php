@extends('layouts.app')

@section('content')
<div class="container-fluid vh-100 d-flex">
    <!-- Sidebar: Danh sách bạn bè -->
    <div class="col-3 border-end bg-light">
        <div class="p-3 border-bottom">
            <h4 class="fw-bold">Danh sách bạn bè</h4>
        </div>
        <ul class="list-group overflow-auto" style="max-height: 80vh;">
            @foreach($friends as $friend)
                <a href="{{ route('chat', ['chatid' => $friend->id]) }}">
                    <li class="list-group-item d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Avatar">
                            <div>
                                <p class="fw-bold mb-0"><?= $friend->name ?></p>
                                <small class="text-muted">Tin nhắn cuối cùng...</small>
                            </div>                    
                    </li>
                </a>
            @endforeach
        </ul>
    </div>

    <!-- Chat Window -->
    <div class="col-9 d-flex flex-column">
        <!-- Header -->
        <div class="d-flex align-items-center p-3 border-bottom bg-primary text-white">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Avatar">
            <h5 class="mb-0">Người dùng 1</h5>
        </div>

        <!-- Message List -->
        <div class="flex-grow-1 p-3 overflow-auto" id="messageContainer">
            <div class="d-flex mb-3">
                <div class="bg-light p-3 rounded w-auto">
                    <p class="mb-0">Chào bạn, tôi là Zalo Bot!</p>
                </div>
                <small class="text-muted ms-2 align-self-end">10:00 AM</small>
            </div>
            <div class="d-flex mb-3 justify-content-end">
                <small class="text-muted me-2 align-self-end">10:01 AM</small>
                <div class="bg-primary text-white p-3 rounded w-auto">
                    <p class="mb-0">Chào bạn, tôi cần giúp đỡ!</p>
                </div>
            </div>
        </div>

        <!-- Input Box -->
        <div class="p-3 border-top d-flex align-items-center">
            <input type="text" class="form-control me-3" placeholder="Nhập tin nhắn..." id="chatInput">
            <button class="btn btn-primary" id="sendMessageBtn">Gửi</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- <script src="{{ asset('js/chat.js') }}"></script> -->

<script>    
    const chatId = 1; 
    const userId = {{ auth()->id() ?? null }};

    const messagesDiv = document.getElementById("messageContainer");
    const messageInput = document.getElementById("chatInput");
    const sendBtn = document.getElementById("sendMessageBtn");

    // Lắng nghe sự kiện WebSocket
    window.Echo.channel(`chat.${chatId}`)
        .listen('MessageSent', (event) => {
            const message = event.message.message;
            const date = new Date(event.message.created_at);
            const hours = date.getHours().toString().padStart(2, '0'); 
            const minutes = date.getMinutes().toString().padStart(2, '0'); 
            let messageElement = null;

            if(event.message.user_id == userId) {
                messageElement = `<div class="d-flex mb-3 justify-content-end">
                                            <small class="text-muted me-2 align-self-end">${hours}:${minutes}</small>
                                            <div class="bg-primary text-white p-3 rounded w-auto">
                                                <p class="mb-0">${message}</p>
                                            </div>
                                        </div>`;
            }else{
                messageElement = `<div class="d-flex mb-3">
                                            <div class="bg-light p-3 rounded w-auto">
                                                <p class="mb-0">${message}</p>
                                            </div>
                                            <small class="text-muted ms-2 align-self-end">${hours}:${minutes}</small>
                                        </div>`;
            }

            messagesDiv.innerHTML += messageElement;
        });


    const sendMessage = () => {
        const message = messageInput.value;

        if (message.trim() === "") return;

        axios.post('/messages', {
            chat_id: chatId,
            message: message
        }).then(response => {
            messageInput.value = "";
        }).catch(error => {
            console.error(error);
        });
    };

    sendBtn.addEventListener("click", sendMessage);
    messageInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter" && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    });

</script>
@endsection