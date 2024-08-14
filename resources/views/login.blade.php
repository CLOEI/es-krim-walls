@extends('layout')

@section('content')
    <div class="auth-container h-screen">
        <div class="auth-modal">
            <div>
                <div class="space-y-4">
                    <div>
                        <h1 class="text-4xl font-bold">Masuk</h1>
                        <p>Silahkan Masukkan Email dan Password
                            yang benar</p>
                    </div>
                    <form action="/login" method="POST" class="space-y-4">
                        @csrf
                        <div class="auth-input-container space-x-2">
                            <div>
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_0_1813)">
                                        <path
                                            d="M12.4391 4.3252H3.08091C2.43486 4.3252 1.91113 4.84892 1.91113 5.49497V11.3438C1.91113 11.9899 2.43486 12.5136 3.08091 12.5136H12.4391C13.0852 12.5136 13.6089 11.9899 13.6089 11.3438V5.49497C13.6089 4.84892 13.0852 4.3252 12.4391 4.3252Z"
                                            stroke="#0AA7BD" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M10.0995 12.5136V3.15537C10.0995 2.84513 9.97627 2.54759 9.75689 2.32821C9.53751 2.10884 9.23998 1.9856 8.92973 1.9856H6.59018C6.27994 1.9856 5.9824 2.10884 5.76303 2.32821C5.54365 2.54759 5.42041 2.84513 5.42041 3.15537V12.5136"
                                            stroke="#0AA7BD" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_0_1813">
                                            <rect width="16.3295" height="16.3295" fill="white"
                                                transform="translate(0.741211 0.230957)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="w-full">
                                <p>Email</p>
                                <input type="email" class="auth-input" name="email">
                            </div>
                        </div>
                        <div class="auth-input-container space-x-2">
                            <div>
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_0_1819)">
                                        <path
                                            d="M11.8548 6.5387H3.66636C3.02031 6.5387 2.49658 7.06242 2.49658 7.70847V11.8027C2.49658 12.4487 3.02031 12.9725 3.66636 12.9725H11.8548C12.5008 12.9725 13.0246 12.4487 13.0246 11.8027V7.70847C13.0246 7.06242 12.5008 6.5387 11.8548 6.5387Z"
                                            stroke="#0AA7BD" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M4.83594 6.53877V4.19922C4.83594 3.42361 5.14405 2.67977 5.69249 2.13133C6.24092 1.58289 6.98477 1.27478 7.76037 1.27478C8.53598 1.27478 9.27982 1.58289 9.82826 2.13133C10.3767 2.67977 10.6848 3.42361 10.6848 4.19922V6.53877"
                                            stroke="#0AA7BD" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_0_1819">
                                            <rect width="16.3295" height="16.3295" fill="white"
                                                transform="translate(0.741699 0.10498)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <div class="w-full">
                                <p>Password</p>
                                <input type="password" class="auth-input" name="password">
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex space-x-4">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember me</label>
                            </div>
                            <div>
                                <a href="/register" class="text-blue-600 underline">Belum punya akun</a>
                            </div>
                        </div>
                        <button type="submit" class="w-full rounded-md text-white py-3 bg-[#096BA2] active:scale-95">
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
