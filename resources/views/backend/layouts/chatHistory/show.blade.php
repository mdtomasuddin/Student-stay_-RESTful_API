@extends('backend.app')

@section('title', 'Chat Details')

@push('styles')
    <style>
        .chat-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .chat-bubble {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            font-size: 14.5px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .chat-bubble.user {
            background-color: #1A8080 !important;
            color: white !important;
            border-bottom-right-radius: 4px;
            margin-left: auto;
        }

        .chat-bubble.ai {
            background-color: #f0f2f5 !important;
            color: #1c1e21 !important;
            border-bottom-left-radius: 4px;
            margin-right: auto;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .chat-timestamp {
            font-size: 11px;
            color: #8e9194;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }

        /* Room Card Styles */
        .room-card-scroll {
            display: flex;
            overflow-x: auto;
            gap: 16px;
            padding: 8px 4px 16px;
            margin: 12px 0;
            scrollbar-width: thin;
            scrollbar-color: #1d7e8733 transparent;
        }

        .room-card-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .room-card-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .room-card-scroll::-webkit-scrollbar-thumb {
            background-color: #1d7e8733;
            border-radius: 10px;
        }

        .room-chat-card {
            flex: 0 0 240px;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eef0f2;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .room-chat-card:hover {
            transform: translateY(-4px);
        }

        .room-image-container {
            height: 150px;
            position: relative;
            background: #f8f9fa;
        }

        .room-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .room-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            padding: 12px;
            color: white;
        }

        .room-property-title {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .room-name {
            font-size: 10px;
            opacity: 0.8;
        }

        .room-details {
            padding: 12px;
        }

        .room-info-label {
            font-size: 11px;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .room-info-value {
            color: #212529;
            font-weight: 500;
            font-size: 11px;
        }

        .room-features-tag {
            font-size: 10px;
            color: #adb5bd;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 8px;
            margin-bottom: 4px;
        }

        .room-amenities {
            font-size: 11px;
            color: #495057;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 32px;
        }

        .room-footer {
            padding: 12px;
            border-top: 1px solid #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .room-price {
            color: #1A8080;
            font-weight: 700;
            font-size: 16px;
        }

        .room-price-unit {
            font-size: 10px;
            color: #adb5bd;
            margin-left: 2px;
        }

        .visit-btn {
            background: #1A8080;
            color: white;
            border: none;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Chat Transcript</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('chat-history.index') }}">Chat History</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 overflow-hidden">
                        {{-- Card Header: Basic Lead Information --}}
                        <div class="card-header bg-white border-bottom p-0">
                            <div
                                class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light-subtle">
                                <h5 class="card-title mb-0 fw-bold text-primary"><i class="ri-information-line me-1"></i>
                                    Lead & Session Information</h5>
                                <a href="{{ route('chat-history.index') }}" class="btn btn-soft-primary btn-sm">
                                    <i class="ri-arrow-left-line me-1"></i> Back to list
                                </a>
                            </div>
                            <div class="p-4">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                                    <i class="ri-user-2-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted small mb-0">Full Name</p>
                                                <h6 class="mb-0 fw-bold">{{ $chat_history->name ?: 'N/A' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success text-success rounded-circle fs-4">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3 overflow-hidden">
                                                <p class="text-muted small mb-0">Email Address</p>
                                                <h6 class="mb-0 fw-bold text-truncate">{{ $chat_history->email ?: 'N/A' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-warning text-warning rounded-circle fs-4">
                                                    <i class="ri-phone-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted small mb-0">Phone</p>
                                                <h6 class="mb-0 fw-bold">{{ $chat_history->phone ?: 'N/A' }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-4">
                                                    <i class="ri-map-pin-user-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted small mb-0">IP Address</p>
                                                <h6 class="mb-0 fw-bold"><span
                                                        class="badge bg-soft-info text-info">{{ $chat_history->ip_address ?: 'N/A' }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-md-end">
                                        <p class="text-muted small mb-0">Session Started</p>
                                        <h6 class="mb-0 fw-bold text-muted">
                                            {{ $chat_history->created_at->format('d M, Y H:i A') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card Body: Chatbot Conversation --}}
                        <div class="card-body bg-light-subtle p-0">
                            <div class="bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="mb-0 fw-bold text-primary"><i class="ri-chat-voice-line fs-5 me-2"></i>
                                    Conversation History</h6>
                                <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill"><i
                                        class="ri-robot-line me-1"></i></span>
                            </div>
                            <div class="chat-container-wrapper p-4 overflow-auto"
                                style="height: 650px; background-image: radial-gradient(#d1d5db 0.5px, transparent 0.5px); background-size: 20px 20px;">
                                <div class="chat-container">
                                    @if (!empty($chat_history->conversations) && is_array($chat_history->conversations))
                                        @foreach ($chat_history->conversations as $index => $message)
                                            {{-- User Message --}}
                                            @if (!empty($message['user']))
                                                <div class="chat-bubble user shadow-sm">
                                                    {{ $message['user'] }}
                                                </div>
                                                <div class="text-end chat-timestamp">
                                                    User
                                                </div>
                                            @endif

                                            {{-- AI Message --}}
                                            @if (!empty($message['ai']))
                                                <div class="chat-bubble ai shadow-sm">
                                                    {{ $message['ai'] }}
                                                </div>
                                                <div class="chat-timestamp">
                                                    AchGoldEstatesBot
                                                </div>
                                            @endif

                                            {{-- Rooms --}}
                                            @if (!empty($message['rooms']) && is_array($message['rooms']))
                                                <div class="room-card-scroll">
                                                    @foreach ($message['rooms'] as $room)
                                                        <div class="room-chat-card shadow-sm border-0">
                                                            <div class="room-image-container">
                                                                @if (!empty($room['images']) && is_array($room['images']) && count($room['images']) > 0)
                                                                    <img src="{{ $room['images'][0] }}"
                                                                        alt="{{ $room['name'] }}" class="room-image">
                                                                @else
                                                                    <div
                                                                        class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted small">
                                                                        No Image</div>
                                                                @endif
                                                                <div class="room-overlay">
                                                                    <p class="room-property-title">
                                                                        {{ $room['property']['title'] ?? 'Property Name' }}
                                                                    </p>
                                                                    <p class="room-name">{{ $room['name'] }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="room-details">
                                                                <div class="mb-1">
                                                                    <span class="room-info-label">Room Type:</span>
                                                                    <span
                                                                        class="room-info-value">{{ $room['room_type'][0]['name'] ?? 'N/A' }}</span>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <span class="room-info-label">Lease:</span>
                                                                    <span
                                                                        class="room-info-value">{{ ($room['tenancy_weeks_min'] ?? 0) . ' Week' }}</span>
                                                                </div>

                                                                <div class="room-features-tag">Features</div>
                                                                <p class="room-amenities">
                                                                    @if (!empty($room['amenities']))
                                                                        {{ implode(', ', array_column($room['amenities'], 'name')) }}
                                                                    @else
                                                                        No features listed
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="room-footer bg-light-subtle">
                                                                <div>
                                                                    <span
                                                                        class="room-price text-primary">£{{ $room['price_per_week'] }}</span>
                                                                    <span class="room-price-unit">/week</span>
                                                                </div>
                                                                <a href="{{ $room['redirect_url'] ?? '#' }}"
                                                                    target="_blank"
                                                                    class="visit-btn btn shadow-none py-1">View Room</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            {{-- Options --}}
                                            @if (!empty($message['options']) && is_array($message['options']))
                                                <div class="d-flex flex-wrap gap-1 mb-4 justify-content-start">
                                                    @foreach ($message['options'] as $option)
                                                        <span
                                                            class="badge rounded-pill bg-soft-secondary text-secondary border px-3 py-2 fw-medium">{{ $option }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="text-center py-5">
                                            <i class="ri-chat-delete-line fs-1 text-muted opacity-50"></i>
                                            <p class="mt-2 text-muted">No conversation history available for this session.
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
