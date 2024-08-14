@extends('layout')

@section('content')
    <div class="flex h-screen overflow-hidden bg-[#F5F5F5]">
        <div class="bg-white h-screen flex-shrink-0">
            <h1 class="text-[#46A2A2] text-3xl font-bold text-center py-4">Admin</h1>
            <div class="px-10 space-y-4 mt-10">
                <a href="/"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'app' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="33.6" height="33.6"
                                fill="{{ Route::currentRouteName() == 'app' ? '#46A2A2' : '' }}" />
                            <path
                                d="M6.99971 7.34998C6.41981 7.34998 5.94971 7.82008 5.94971 8.39998C5.94971 8.97987 6.41981 9.44998 6.99971 9.44998H26.5997C27.1796 9.44998 27.6497 8.97987 27.6497 8.39998C27.6497 7.82008 27.1796 7.34998 26.5997 7.34998H6.99971Z"
                                fill="#766F6F" />
                            <path
                                d="M6.99971 12.95C6.41981 12.95 5.94971 13.4201 5.94971 14C5.94971 14.5799 6.41981 15.05 6.99971 15.05H26.5997C27.1796 15.05 27.6497 14.5799 27.6497 14C27.6497 13.4201 27.1796 12.95 26.5997 12.95H6.99971Z"
                                fill="#766F6F" />
                            <path
                                d="M6.99971 18.55C6.41981 18.55 5.94971 19.0201 5.94971 19.6C5.94971 20.1799 6.41981 20.65 6.99971 20.65H26.5997C27.1796 20.65 27.6497 20.1799 27.6497 19.6C27.6497 19.0201 27.1796 18.55 26.5997 18.55H6.99971Z"
                                fill="#766F6F" />
                            <path
                                d="M6.99971 24.15C6.41981 24.15 5.94971 24.6201 5.94971 25.2C5.94971 25.7799 6.41981 26.25 6.99971 26.25H26.5997C27.1796 26.25 27.6497 25.7799 27.6497 25.2C27.6497 24.6201 27.1796 24.15 26.5997 24.15H6.99971Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Dashboard</p>
                </a>
                <a href="/daftar_barang"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'daftar_barang' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'daftar_barang' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_0_131)">
                                <path
                                    d="M14.7001 25.2164V15.3563L4.2001 10.1063V24.5438L13.1251 29.0227L12.6165 31.1063L2.1001 25.8563V7.74377L15.7501 0.935181L29.4001 7.74377V12.1735C28.6345 12.2938 27.9345 12.5399 27.3001 12.9117V10.1063L16.8001 15.3563V23.1164L14.7001 25.2164ZM12.3704 4.95471L21.9517 10.4344L26.004 8.40002L15.7501 3.26487L12.3704 4.95471ZM15.7501 13.5352L19.6876 11.5664L10.1063 6.08674L5.49619 8.40002L15.7501 13.5352ZM30.3188 14.7C30.7782 14.7 31.2048 14.7821 31.5985 14.9461C31.9923 15.1102 32.3423 15.3344 32.6485 15.6188C32.9548 15.9031 33.1845 16.2477 33.3376 16.6524C33.4907 17.0571 33.5782 17.4891 33.6001 17.9485C33.6001 18.375 33.5181 18.7906 33.354 19.1953C33.1899 19.6 32.9548 19.9555 32.6485 20.2617L20.8853 32.025L14.7001 33.5672L16.2423 27.3821L28.0056 15.6352C28.3228 15.318 28.6782 15.0828 29.072 14.9297C29.4657 14.7766 29.8813 14.7 30.3188 14.7ZM31.1556 18.7852C31.3853 18.5555 31.5001 18.2766 31.5001 17.9485C31.5001 17.6094 31.3907 17.336 31.172 17.1281C30.9532 16.9203 30.6688 16.811 30.3188 16.8C30.1657 16.8 30.0181 16.8219 29.8759 16.8656C29.7337 16.9094 29.6079 16.9914 29.4985 17.1117L18.1454 28.4649L17.5876 30.6797L19.8024 30.1219L31.1556 18.7852Z"
                                    fill="#766F6F" />
                            </g>
                            <defs>
                                <clipPath id="clip0_0_131">
                                    <rect width="33.6" height="33.6" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <p>Daftar Barang</p>
                </a>
                <a href="/daftar_barang_keluar"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'daftar_barang_keluar' ? 'text-green-500' : '' }}">
                    <div><svg width="33" height="34" viewBox="0 0 33 34"
                            fill="{{ Route::currentRouteName() == 'daftar_barang_keluar' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.4688 8.5H12.375C9.78175 8.5 8.4865 8.5 7.68075 9.33017C6.875 10.1603 6.875 11.4948 6.875 14.1667V23.0208H26.125V14.1667C26.125 11.4948 26.125 10.1603 25.3193 9.33017C24.5135 8.5 23.2183 8.5 20.625 8.5H17.5312V15.5451L18.4663 14.4203C18.5544 14.3142 18.6619 14.2271 18.7827 14.1639C18.9035 14.1006 19.0352 14.0625 19.1703 14.0517C19.3054 14.041 19.4412 14.0577 19.57 14.101C19.6988 14.1443 19.8181 14.2133 19.921 14.3041C20.0239 14.3949 20.1085 14.5057 20.1699 14.6301C20.2312 14.7546 20.2682 14.8903 20.2787 15.0294C20.2891 15.1686 20.2729 15.3086 20.2309 15.4413C20.1888 15.574 20.1219 15.6969 20.0337 15.8029L17.2837 19.108C17.1869 19.2246 17.0667 19.3183 16.9314 19.3825C16.7962 19.4467 16.649 19.48 16.5 19.48C16.351 19.48 16.2038 19.4467 16.0686 19.3825C15.9333 19.3183 15.8131 19.2246 15.7163 19.108L12.9663 15.8029C12.8781 15.6969 12.8112 15.574 12.7691 15.4413C12.7271 15.3086 12.7109 15.1686 12.7213 15.0294C12.7318 14.8903 12.7688 14.7546 12.8301 14.6301C12.8915 14.5057 12.9761 14.3949 13.079 14.3041C13.1819 14.2133 13.3012 14.1443 13.43 14.101C13.5588 14.0577 13.6946 14.041 13.8297 14.0517C13.9648 14.0625 14.0965 14.1006 14.2173 14.1639C14.3381 14.2271 14.4456 14.3142 14.5337 14.4203L15.4688 15.5451V8.5ZM6.91625 25.1458H26.0837C26.0122 26.265 25.8239 26.9832 25.3193 27.5032C24.5135 28.3333 23.2183 28.3333 20.625 28.3333H12.375C9.78175 28.3333 8.4865 28.3333 7.68075 27.5032C7.17612 26.9832 6.98638 26.2664 6.91625 25.1458Z"
                                fill="#766F6F" />
                            <path
                                d="M8.09745 4.25H24.9013C27.8576 4.25 30.2501 6.8 30.2501 9.945C30.2501 11.7725 29.4429 13.3974 28.1876 14.4401V14.0406C28.1876 12.8138 28.1876 11.6889 28.0679 10.7752C27.9373 9.76792 27.6279 8.70258 26.7782 7.8285C25.9284 6.95158 24.8944 6.63283 23.9182 6.49683C23.0299 6.375 21.9382 6.375 20.7474 6.375H12.2513C11.0619 6.375 9.97019 6.375 9.08332 6.49825C8.1057 6.63283 7.0717 6.95158 6.22332 7.82708C5.3722 8.70258 5.06282 9.76792 4.93082 10.7738C4.81257 11.6889 4.81257 12.8138 4.81257 14.0406V14.4401C4.16454 13.8973 3.64287 13.2117 3.28593 12.4338C2.929 11.6559 2.74589 10.8054 2.75007 9.945C2.75007 6.8 5.14394 4.25 8.09745 4.25Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Daftar Barang Keluar</p>
                </a>
                <a href="/daftar_barang_masuk"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'daftar_barang_masuk' ? 'text-green-500' : '' }}">
                    <div><svg width="33" height="34" viewBox="0 0 33 34"
                            fill="{{ Route::currentRouteName() == 'daftar_barang_masuk' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.5312 25.5H20.625C23.2183 25.5 24.5135 25.5 25.3193 24.6698C26.125 23.8397 26.125 22.5052 26.125 19.8333L26.125 10.9792L6.875 10.9792L6.875 19.8333C6.875 22.5052 6.875 23.8397 7.68075 24.6698C8.4865 25.5 9.78175 25.5 12.375 25.5H15.4688V18.4549L14.5337 19.5797C14.4456 19.6858 14.3381 19.7729 14.2173 19.8361C14.0965 19.8994 13.9648 19.9375 13.8297 19.9483C13.6946 19.959 13.5588 19.9423 13.43 19.899C13.3012 19.8557 13.1819 19.7867 13.079 19.6959C12.9761 19.6051 12.8915 19.4943 12.8301 19.3699C12.7688 19.2454 12.7318 19.1097 12.7213 18.9706C12.7109 18.8314 12.7271 18.6914 12.7691 18.5587C12.8112 18.426 12.8781 18.3031 12.9663 18.1971L15.7163 14.892C15.8131 14.7754 15.9333 14.6817 16.0686 14.6175C16.2038 14.5533 16.351 14.52 16.5 14.52C16.649 14.52 16.7962 14.5533 16.9314 14.6175C17.0667 14.6817 17.1869 14.7754 17.2837 14.892L20.0337 18.1971C20.1219 18.3031 20.1888 18.426 20.2309 18.5587C20.2729 18.6914 20.2891 18.8314 20.2787 18.9706C20.2682 19.1097 20.2312 19.2454 20.1699 19.3699C20.1085 19.4943 20.0239 19.6051 19.921 19.6959C19.8181 19.7867 19.6988 19.8557 19.57 19.899C19.4412 19.9423 19.3054 19.959 19.1703 19.9483C19.0352 19.9375 18.9035 19.8994 18.7827 19.8361C18.6619 19.7729 18.5544 19.6858 18.4663 19.5797L17.5312 18.4549V25.5ZM26.0837 8.85417L6.91625 8.85417C6.98775 7.735 7.17613 7.01675 7.68075 6.49683C8.4865 5.66667 9.78175 5.66667 12.375 5.66667H20.625C23.2183 5.66667 24.5135 5.66667 25.3193 6.49683C25.8239 7.01675 26.0136 7.73358 26.0837 8.85417Z"
                                fill="#766F6F" />
                            <path
                                d="M24.9026 29.75L8.09868 29.75C5.14243 29.75 2.74993 27.2 2.74993 24.055C2.74993 22.2275 3.55705 20.6026 4.81243 19.5599V19.9594C4.81243 21.1862 4.81243 22.3111 4.93205 23.2248C5.06268 24.2321 5.37205 25.2974 6.2218 26.1715C7.07155 27.0484 8.10555 27.3672 9.0818 27.5032C9.97005 27.625 11.0618 27.625 12.2526 27.625L20.7487 27.625C21.9381 27.625 23.0298 27.625 23.9167 27.5017C24.8943 27.3672 25.9283 27.0484 26.7767 26.1729C27.6278 25.2974 27.9372 24.2321 28.0692 23.2262C28.1874 22.3111 28.1874 21.1862 28.1874 19.9594V19.5599C28.8355 20.1027 29.3571 20.7883 29.7141 21.5662C30.071 22.3441 30.2541 23.1946 30.2499 24.055C30.2499 27.2 27.8561 29.75 24.9026 29.75Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Daftar Barang Masuk</p>
                </a>
                <a href="/tambah_outlet"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'tambah_outlet' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'tambah_outlet' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_0_145)">
                                <path
                                    d="M26.4443 28.3333H15.1109V20.7778H13.2221V28.3333H7.55539V20.7778H5.6665V28.3333C5.6665 28.8343 5.86551 29.3147 6.21975 29.669C6.57398 30.0232 7.05443 30.2222 7.55539 30.2222H26.4443C26.9452 30.2222 27.4257 30.0232 27.7799 29.669C28.1342 29.3147 28.3332 28.8343 28.3332 28.3333V20.7778H26.4443V28.3333Z"
                                    fill="#766F6F" />
                                <path
                                    d="M31.9126 12.5328L28.0592 4.8261C27.9029 4.5114 27.6618 4.24657 27.3631 4.06137C27.0645 3.87617 26.7201 3.77796 26.3687 3.77777H7.63091C7.2795 3.77796 6.9351 3.87617 6.63645 4.06137C6.3378 4.24657 6.09673 4.5114 5.94035 4.8261L2.08702 12.5328C1.95546 12.7967 1.88753 13.0878 1.88869 13.3828V16.2917C1.88782 16.733 2.04153 17.1607 2.32313 17.5006C2.73931 17.9776 3.25331 18.3595 3.83021 18.6202C4.40711 18.881 5.03338 19.0145 5.66646 19.0117C6.69947 19.0133 7.70097 18.6561 8.4998 18.0011C9.29862 18.6564 10.2999 19.0146 11.3331 19.0146C12.3664 19.0146 13.3676 18.6564 14.1665 18.0011C14.9653 18.6564 15.9666 19.0146 16.9998 19.0146C18.033 19.0146 19.0343 18.6564 19.8331 18.0011C20.632 18.6564 21.6332 19.0146 22.6665 19.0146C23.6997 19.0146 24.701 18.6564 25.4998 18.0011C26.3915 18.7333 27.5323 19.0912 28.6825 18.9996C29.8326 18.908 30.9024 18.374 31.667 17.51C31.952 17.1715 32.1091 16.7436 32.1109 16.3011V13.3828C32.1121 13.0878 32.0441 12.7967 31.9126 12.5328ZM14.1665 13.6V15.0355L13.392 16.0555C13.1543 16.3796 12.8436 16.6431 12.4851 16.8247C12.1265 17.0063 11.7303 17.101 11.3284 17.101C10.9265 17.101 10.5303 17.0063 10.1718 16.8247C9.81324 16.6431 9.50254 16.3796 9.2648 16.0555L8.4998 14.9978V13.6L10.9459 5.66666H15.1109L14.1665 13.6ZM25.4998 14.9978L24.7348 16.0555C24.4971 16.3796 24.1864 16.6431 23.8278 16.8247C23.4693 17.0063 23.0731 17.101 22.6712 17.101C22.2693 17.101 21.873 17.0063 21.5145 16.8247C21.156 16.6431 20.8453 16.3796 20.6076 16.0555L19.8331 14.9978V13.6L18.8887 5.66666H23.0915L25.4998 13.6V14.9978Z"
                                    fill="#766F6F" />
                            </g>
                            <defs>
                                <clipPath id="clip0_0_145">
                                    <rect width="34" height="34" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <p>Tambah Outlet Baru</p>
                </a>
                <a href="/tambah_produk"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'tambah_produk' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'tambah_produk' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 19.125H14.875V21.25H8.5V19.125ZM8.5 23.375H19.125V25.5H8.5V23.375Z"
                                fill="#766F6F" />
                            <path
                                d="M27.625 4.25H6.375C5.81167 4.25084 5.27166 4.475 4.87333 4.87333C4.475 5.27166 4.25084 5.81167 4.25 6.375V27.625C4.25084 28.1883 4.475 28.7283 4.87333 29.1267C5.27166 29.525 5.81167 29.7492 6.375 29.75H27.625C28.1883 29.7492 28.7283 29.525 29.1267 29.1267C29.525 28.7283 29.7492 28.1883 29.75 27.625V6.375C29.7492 5.81167 29.525 5.27166 29.1267 4.87333C28.7283 4.475 28.1883 4.25084 27.625 4.25ZM19.125 6.375V10.625H14.875V6.375H19.125ZM6.375 27.625V6.375H12.75V12.75H21.25V6.375H27.625L27.6261 27.625H6.375Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Tambah Produk Baru</p>
                </a>
                <a href="/laporan_stok"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'laporan_stok' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'laporan_stok' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.625 19.125H19.125V21.25H10.625V19.125ZM10.625 13.8125H23.375V15.9375H10.625V13.8125ZM10.625 24.4375H15.9375V26.5625H10.625V24.4375Z"
                                fill="#766F6F" />
                            <path
                                d="M26.5625 5.3125H23.375V4.25C23.375 3.68641 23.1511 3.14591 22.7526 2.7474C22.3541 2.34888 21.8136 2.125 21.25 2.125H12.75C12.1864 2.125 11.6459 2.34888 11.2474 2.7474C10.8489 3.14591 10.625 3.68641 10.625 4.25V5.3125H7.4375C6.87391 5.3125 6.33341 5.53638 5.9349 5.9349C5.53638 6.33341 5.3125 6.87391 5.3125 7.4375V29.75C5.3125 30.3136 5.53638 30.8541 5.9349 31.2526C6.33341 31.6511 6.87391 31.875 7.4375 31.875H26.5625C27.1261 31.875 27.6666 31.6511 28.0651 31.2526C28.4636 30.8541 28.6875 30.3136 28.6875 29.75V7.4375C28.6875 6.87391 28.4636 6.33341 28.0651 5.9349C27.6666 5.53638 27.1261 5.3125 26.5625 5.3125ZM12.75 4.25H21.25V8.5H12.75V4.25ZM26.5625 29.75H7.4375V7.4375H10.625V10.625H23.375V7.4375H26.5625V29.75Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Laporan Stok</p>
                </a>
                <a href="/laporan_barang_masuk"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'laporan_barang_masuk' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'laporan_barang_masuk' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.625 19.125H19.125V21.25H10.625V19.125ZM10.625 13.8125H23.375V15.9375H10.625V13.8125ZM10.625 24.4375H15.9375V26.5625H10.625V24.4375Z"
                                fill="#766F6F" />
                            <path
                                d="M26.5625 5.3125H23.375V4.25C23.375 3.68641 23.1511 3.14591 22.7526 2.7474C22.3541 2.34888 21.8136 2.125 21.25 2.125H12.75C12.1864 2.125 11.6459 2.34888 11.2474 2.7474C10.8489 3.14591 10.625 3.68641 10.625 4.25V5.3125H7.4375C6.87391 5.3125 6.33341 5.53638 5.9349 5.9349C5.53638 6.33341 5.3125 6.87391 5.3125 7.4375V29.75C5.3125 30.3136 5.53638 30.8541 5.9349 31.2526C6.33341 31.6511 6.87391 31.875 7.4375 31.875H26.5625C27.1261 31.875 27.6666 31.6511 28.0651 31.2526C28.4636 30.8541 28.6875 30.3136 28.6875 29.75V7.4375C28.6875 6.87391 28.4636 6.33341 28.0651 5.9349C27.6666 5.53638 27.1261 5.3125 26.5625 5.3125ZM12.75 4.25H21.25V8.5H12.75V4.25ZM26.5625 29.75H7.4375V7.4375H10.625V10.625H23.375V7.4375H26.5625V29.75Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Laporan Barang Masuk</p>
                </a>
                <a href="/laporan_barang_keluar"
                    class="flex space-x-2 items-center {{ Route::currentRouteName() == 'laporan_barang_keluar' ? 'text-green-500' : '' }}">
                    <div><svg width="34" height="34" viewBox="0 0 34 34"
                            fill="{{ Route::currentRouteName() == 'laporan_barang_keluar' ? '#46A2A2' : '' }}"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.625 19.125H19.125V21.25H10.625V19.125ZM10.625 13.8125H23.375V15.9375H10.625V13.8125ZM10.625 24.4375H15.9375V26.5625H10.625V24.4375Z"
                                fill="#766F6F" />
                            <path
                                d="M26.5625 5.3125H23.375V4.25C23.375 3.68641 23.1511 3.14591 22.7526 2.7474C22.3541 2.34888 21.8136 2.125 21.25 2.125H12.75C12.1864 2.125 11.6459 2.34888 11.2474 2.7474C10.8489 3.14591 10.625 3.68641 10.625 4.25V5.3125H7.4375C6.87391 5.3125 6.33341 5.53638 5.9349 5.9349C5.53638 6.33341 5.3125 6.87391 5.3125 7.4375V29.75C5.3125 30.3136 5.53638 30.8541 5.9349 31.2526C6.33341 31.6511 6.87391 31.875 7.4375 31.875H26.5625C27.1261 31.875 27.6666 31.6511 28.0651 31.2526C28.4636 30.8541 28.6875 30.3136 28.6875 29.75V7.4375C28.6875 6.87391 28.4636 6.33341 28.0651 5.9349C27.6666 5.53638 27.1261 5.3125 26.5625 5.3125ZM12.75 4.25H21.25V8.5H12.75V4.25ZM26.5625 29.75H7.4375V7.4375H10.625V10.625H23.375V7.4375H26.5625V29.75Z"
                                fill="#766F6F" />
                        </svg>
                    </div>
                    <p>Laporan Barang Keluar</p>
                </a>
                <form action="/logout" method="GET">
                    @csrf
                    <button class="flex space-x-2 items-center">
                        <div><svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M28.8201 24.3047H26.4859C26.3265 24.3047 26.1771 24.3744 26.0775 24.4973C25.8451 24.7795 25.5961 25.0518 25.3337 25.3107C24.261 26.3847 22.9902 27.2405 21.5918 27.8309C20.143 28.4428 18.5858 28.7567 17.013 28.7539C15.4226 28.7539 13.882 28.4418 12.4343 27.8309C11.0359 27.2405 9.76513 26.3847 8.69234 25.3107C7.61762 24.2405 6.76065 22.9719 6.1689 21.5754C5.55465 20.1277 5.24586 18.5904 5.24586 17C5.24586 15.4096 5.55797 13.8723 6.1689 12.4246C6.75992 11.0268 7.60992 9.76836 8.69234 8.68926C9.77476 7.61016 11.0332 6.76016 12.4343 6.16915C13.882 5.55821 15.4226 5.2461 17.013 5.2461C18.6035 5.2461 20.1441 5.55489 21.5918 6.16915C22.9929 6.76016 24.2513 7.61016 25.3337 8.68926C25.5961 8.95157 25.8418 9.22383 26.0775 9.50274C26.1771 9.62559 26.3298 9.69532 26.4859 9.69532H28.8201C29.0293 9.69532 29.1587 9.4629 29.0425 9.28692C26.4959 5.32911 22.04 2.70938 16.9765 2.72266C9.02105 2.74258 2.64273 9.20059 2.72242 17.1461C2.80211 24.9654 9.17047 31.2773 17.013 31.2773C22.0632 31.2773 26.4992 28.6609 29.0425 24.7131C29.1554 24.5371 29.0293 24.3047 28.8201 24.3047ZM31.7718 16.7908L27.0603 13.0721C26.8843 12.9326 26.6287 13.0588 26.6287 13.2813V15.8047H16.2029C16.0568 15.8047 15.9373 15.9242 15.9373 16.0703V17.9297C15.9373 18.0758 16.0568 18.1953 16.2029 18.1953H26.6287V20.7188C26.6287 20.9412 26.8877 21.0674 27.0603 20.9279L31.7718 17.2092C31.8036 17.1843 31.8293 17.1526 31.8469 17.1163C31.8646 17.0801 31.8737 17.0403 31.8737 17C31.8737 16.9597 31.8646 16.9199 31.8469 16.8837C31.8293 16.8474 31.8036 16.8157 31.7718 16.7908Z"
                                    fill="#766F6F" />
                            </svg>
                        </div>
                        <p class="">Keluar</p>
                    </button>
                </form>
            </div>
        </div>
        <div class="w-full flex flex-col">
            <div class="h-20 flex-shrink-0 bg-[#138FA0] flex items-center justify-end px-10">
                <div class="flex space-x-2 items-center">
                    <div class="w-12 h-12 rounded-md bg-gray-300"></div>
                    <p>{{ auth()->user()->first_name }}</p>
                </div>
            </div>
            <div class="p-10 flex-1 flex flex-col">
                @yield('body_content')
            </div>
        </div>
    </div>
@endsection
