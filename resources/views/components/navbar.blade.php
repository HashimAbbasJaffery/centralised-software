<aside
class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
{{ $attributes }}
>
<div class="py-4 text-gray-500 dark:text-gray-400">
  <a
    class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
    href="#"
  >
    Windmill
  </a>
  <ul class="mt-6" style="height: 100%;">
    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="togglePagesMenu"
        aria-haspopup="true"
        style="outline: none;"
      >
        <span class="inline-flex items-center">
          <svg class="w-5 h-5" style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448 80l0 48c0 44.2-100.3 80-224 80S0 172.2 0 128L0 80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6L448 288c0 44.2-100.3 80-224 80S0 332.2 0 288L0 186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6l0 85.9c0 44.2-100.3 80-224 80S0 476.2 0 432l0-85.9z"/></svg>
          <span class="ml-4" style="font-size: 12px;">Member's database</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isPagesMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('member.create') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route("member.create") }}">Add member</a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('member.manage') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route("member.manage") }}">
              Manage member
            </a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('member.birthdays') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route('member.birthdays') }}">
              birthdays
            </a>
          </li>
        </ul>
      </template>
    </li>
  </ul>
  <ul>
    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="toggleRecoveryMenu"
        aria-haspopup="true"
        style="outline: none;"
      >
        <span class="inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px;" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M463.5 224l8.5 0c13.3 0 24-10.7 24-24l0-128c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1c-87.5 87.5-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8l119.5 0z"/></svg><span class="ml-4" style="font-size: 12px;">Recovery</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isRecoveryMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          >
            <a class="w-full" href="{{ route('payment-schedule') }}" style="font-size: 12px;">View Payment Schedule</a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          >
            <a class="w-full" href="{{ route('member.recovery.report') }}" style="font-size: 12px;">
              Recovery report by members
            </a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          >
            <a class="w-full" href="./forgot-password.html" style="font-size: 12px;">
              Recovery payment receipt
            </a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          >
            <a class="w-full" href="{{ route('member.recovery.overall') }}" style="font-size: 12px;">
              Recovery report overall
            </a>
          </li>
        </ul>
      </template>
    </li>
  </ul>
  <ul>
    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="toggleReciprocalMenu"
        aria-haspopup="true"
        style="outline: none;"
      >
        <span class="inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px;" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z"/></svg><span class="ml-4" style="font-size: 12px;">Reciprocal</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isReciprocalMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('introletter.index') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route('introletter.index') }}">Create Introduction letter</a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('club.index') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route('club.index') }}">
              Manage Clubs
            </a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('club.create') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route("club.create") }}">
              Add clubs
            </a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('duration.index') ? 'text-black' : '' }}"
          >
            <a class="w-full" style="font-size: 12px;" href="{{ route("duration.index") }}">
              Add duration and fees
            </a>
          </li>
        </ul>
      </template>
    </li>
  </ul>
  <ul>
    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="toggleMembershipMenu"
        aria-haspopup="true"
        style="outline: none;"
      >
        <span class="inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px;" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 256l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L80 384c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
          <span class="ml-4" style="font-size: 12px;">Membership Card</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isMembershipCardMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('card-type.add') ? 'text-black' : '' }}"
          >
            <a class="w-full" href="{{ route('card-type.add') }}" style="font-size: 12px;">Add Card</a>
          </li>
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('card-type.index') ? 'text-black' : '' }}"
          >
            <a class="w-full" href="{{ route('card-type.index') }}" style="font-size: 12px;">
              Manage Card
            </a>
          </li>
        </ul>
      </template>
    </li>
  </ul>
  <ul>
    <li class="relative px-6 py-3">
      <button
        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
        @click="toggleComplainsMenu"
        aria-haspopup="true"
        style="outline: none;"
      >
        <span class="inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" style="width: 15px;" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/></svg>     <span class="ml-4" style="font-size: 12px;">Complains &amp; Inquiry</span>
        </span>
        <svg
          class="w-4 h-4"
          aria-hidden="true"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </button>
      <template x-if="isComplainsMenuOpen">
        <ul
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-25 max-h-0"
          x-transition:enter-end="opacity-100 max-h-xl"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-xl"
          x-transition:leave-end="opacity-0 max-h-0"
          class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
          aria-label="submenu"
        >
          <li
            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
          >
            <a class="w-full" href="./login.html" style="font-size: 12px;">Member Complain</a>
          </li>
        </ul>
      </template>
    </li>
  </ul>
</div>
</aside>