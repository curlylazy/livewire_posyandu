{{-- @assets
    <style>
        .loading-state {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.541);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .loading {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 10px solid #ddd;
            border-top-color: orange;
            animation: loading 1s linear infinite;
        }
        @keyframes loading {
            to {
                transform: rotate(360deg);
            }
        }

        .lds-roller {
            /* change color here */
            color: #f3f3f3
        }

        .lds-roller,
        .lds-roller div,
        .lds-roller div:after {
            box-sizing: border-box;
        }
        .lds-roller {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
        }
        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7.2px;
            height: 7.2px;
            border-radius: 50%;
            background: currentColor;
            margin: -3.6px 0 0 -3.6px;
        }
        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }
        .lds-roller div:nth-child(1):after {
            top: 62.62742px;
            left: 62.62742px;
        }
        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }
        .lds-roller div:nth-child(2):after {
            top: 67.71281px;
            left: 56px;
        }
        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }
        .lds-roller div:nth-child(3):after {
            top: 70.90963px;
            left: 48.28221px;
        }
        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }
        .lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }
        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }
        .lds-roller div:nth-child(5):after {
            top: 70.90963px;
            left: 31.71779px;
        }
        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }
        .lds-roller div:nth-child(6):after {
            top: 67.71281px;
            left: 24px;
        }
        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }
        .lds-roller div:nth-child(7):after {
            top: 62.62742px;
            left: 17.37258px;
        }
        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }
        .lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12.28719px;
        }
        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }


    </style>
@endassets

<div>
    <div class="loading-state" wire:loading.flex>
        <div class="d-flex flex-column">
            <div class="text-center">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <div class="h5 fw-bold text-white mt-3">{{ $msg ?? 'LOADING' }}</div>
        </div>
    </div>
</div>
 --}}

<div class="logo-loader" wire:loading.flex>

    @assets
        <style>

            html {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .loader-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(247, 242, 248, 0.822);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999; /* supaya di atas segalanya */
            }

            .logo {
                width: 150px;
                animation: blink 2s infinite;
            }

            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.2; }
            }

            .dots span {
                display: inline-block;
                width: 10px;
                height: 10px;
                margin: 0 5px;
                background: #3498db;
                border-radius: 50%;
                animation: bounce 1.4s infinite ease-in-out both;
            }

            .dots span:nth-child(1) { animation-delay: -0.32s; }
            .dots span:nth-child(2) { animation-delay: -0.16s; }
            .dots span:nth-child(3) { animation-delay: 0; }

            @keyframes bounce {
                0%, 80%, 100% { transform: scale(0); }
                40% { transform: scale(1.0); }
            }
        </style>
    @endassets

    <div class="loader-container">
        <div class="d-flex flex-column">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
            <div class="text-center" style="font-size: 15pt; font-weight: bold; color: rgb(121, 121, 121);">LOADING</div>
        </div>
    </div>
</div>

{{-- <div class="logo-loader">
    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 768 768">
      <!-- Biru -->
      <g class="fig fig-1">
        <circle cx="192" cy="206" r="30" fill="#007BFF" />
        <path d="M132,256 Q192,296 252,256" fill="#007BFF" />
      </g>
      <!-- Oranye -->
      <g class="fig fig-2">
        <circle cx="384" cy="78" r="30" fill="#FFA500" />
        <path d="M324,128 Q384,168 444,128" fill="#FFA500" />
      </g>
      <!-- Pink -->
      <g class="fig fig-3">
        <circle cx="576" cy="206" r="30" fill="#FF1493" />
        <path d="M516,256 Q576,296 636,256" fill="#FF1493" />
      </g>
      <!-- Hijau -->
      <g class="fig fig-4">
        <circle cx="384" cy="462" r="30" fill="#32CD32" />
        <path d="M324,512 Q384,552 444,512" fill="#32CD32" />
      </g>
    </svg>
  </div>

  <style>
  .logo-loader {
    position: fixed;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .fig {
    animation: blink 4s infinite;
    transform-origin: center;
    opacity: 0.9;
  }
  .fig-1 { animation-delay: 0s; }
  .fig-2 { animation-delay: 1s; }
  .fig-3 { animation-delay: 2s; }
  .fig-4 { animation-delay: 3s; }

  @keyframes blink {
    0%, 100% { opacity: 0.9; transform: scale(1); }
    50% { opacity: 0.2; transform: scale(1.1); }
  }
  </style> --}}

