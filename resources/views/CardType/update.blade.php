<x-layout.app>
        <style>
          .iti {
            width: 100%;
          }
              /* .contain-2{
            width: 70%;
            height: 100%;
        } */

        @font-face {
          font-family: 'kefa';
          src: url('{{ asset("/assets/fonts/kefa.ttf") }}');
        }
        .card-custom-front{
          
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               /* Your existing styles */
            /* background-image: url("images/bg_card_front.webp"); */
            color: #fff;
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        
        }
        
        /* .card-custom {
            background-color: #857147;
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 20px; 

        } */

        .card-custom-front::before,
.card-custom-front::after {
    content: "";
    position: absolute;
    background: #000; /* Line color */
}

/* Top and Bottom lines */
.card-custom-front::before {
    width: 2px; /* Line thickness */
    height: 0.5cm; /* Height of the line */
    left: 50%; /* Center alignment */
    transform: translateX(-50%);
    top: 0; /* Top line */
}

.card-custom-front::after {
    width: 2px; /* Line thickness */
    height: 0.5cm; /* Height of the line */
    left: 50%; /* Center alignment */
    transform: translateX(-50%);
    bottom: 0; /* Bottom line */
}

/* Left line */
.card-custom-front .before-left {
    content: "";
    position: absolute;
    background: #000;
    height: 0.5cm; /* Full height */
    width: 2px; /* Line thickness */
    top: 50%;
    right: 0; /* Left side */
    transform: translateY(45%);
    rotate: 90deg;
}

/* Right line */
.card-custom-front .after-right {
    content: "";
    position: absolute;
    background: #000;
    height: 0.5cm; /* Full height */
    width: 2px; /* Line thickness */
    top:50%;
    left: 0; /* Right side */
    transform: translateY(-45%);
    rotate: 90deg;
}


        /* .card-body {
            display: flex;
            justify-content: space-between;
          
        } */

        .members_info-front {
            font-size: 40%;
            color: #fff;
            font-weight: 500;
        }
td h6{
    font-family: kefa;
    font-weight: 400;
}
.bc-head-txt-label {
        left: calc(50% - .5rem);
        line-height: 1;
        padding-top: .5rem;
        position: relative;
        transform: rotate(180deg);
        white-space: nowrap;
        writing-mode: vertical-rl;
        color: #fff;
        font-weight: 500;
        font-size: 50%;


    }

    .card-custom {
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 20px; 

        }

        .card-custom::before,
    .card-custom::after {
        content: "";
        position: absolute;
        background: #000; /* Line color */
    }

    /* Top and Bottom lines */
    .card-custom::before {
        width: 2px; /* Line thickness */
        height: 0.5cm; /* Height of the line */
        left: 50%; /* Center alignment */
        transform: translateX(-50%);
        top: 0; /* Top line */
    }

    .card-custom::after {
        width: 2px; /* Line thickness */
        height: 0.5cm; /* Height of the line */
        left: 50%; /* Center alignment */
        transform: translateX(-50%);
        bottom: 0; /* Bottom line */
    }

    /* Left line */
    .card-custom .before-left {
        content: "";
        position: absolute;
        background: #000;
        height: 0.5cm; /* Full height */
        width: 2px; /* Line thickness */
        top: 50%;
        right: 0; /* Left side */
        transform: translateY(45%);
        rotate: 90deg;
    }

    /* Right line */
    .card-custom .after-right {
        content: "";
        position: absolute;
        background: #000;
        height: 0.5cm; /* Full height */
        width: 2px; /* Line thickness */
        top:50%;
        left: 0; /* Right side */
        transform: translateY(-45%);
        rotate: 90deg;
    }


            .members_info {
                font-size: 43%;
                color: #fff;
                font-weight: 600;
            }

            .card-footer-custom {
                font-size: 16px;
            }
            .card-custom-front {
  position: relative;
  z-index: 1;
}

.card-custom-front .building-images {
  -webkit-mask-image: url("{{ asset('assets/img/front.png') }}");
  -webkit-mask-repeat: no-repeat;
  -webkit-mask-size: cover;
  mask-image: url("{{ asset('assets/img/front.png') }}");
  mask-repeat: no-repeat;
  mask-size: cover;

  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;

  z-index: 1; /* LOWER than card-body */
  pointer-events: none;
}

.card-custom-front .card-body {
  position: relative;
  z-index: 2;
}

        </style>
        <main id="app" class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Create Card Type
            </h2>
            <form @submit="submit">
              <div class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div style="display: flex; column-gap: 20px;">
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Card Name</span>
                      <input v-model="card_name" data-message="member_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Permanent">
                    </label>
                  </div>
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Card Color</span>
                      <input 
                          v-model="card_color" 
                          type="color" 
                          data-message="cnic_field_message" 
                          class="block w-16 h-10 mt-1 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-pointer"
                          style="width: 100%; padding: 5px;"
                        >
                    </label>
                  </div>
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Shade Color</span>
                      <input 
                          v-model="shade_color" 
                          type="color" 
                          data-message="cnic_field_message" 
                          class="block w-16 h-10 mt-1 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-pointer"
                          style="width: 100%; padding: 5px;"
                        >
                    </label>
                  </div>
                </div>
                <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Update
                </button>
              </div>
            </form>
 <table class="table">
  <tbody>
    <tr>
      <td style="width: 50%;">
        <div class="card card-custom-front mx-1 mt-3 p-3" id="colorPreview1"
     style="width: 320px; position: relative;" 
     :style="{ 'background': card_color }">

  <!-- Background mask -->
  <div class="building-images" :style="{ background: shade_color }"></div>

  <!-- Other visual layers -->
  <div class="before-left"></div>
  <div class="after-right"></div>

  <!-- Foreground content -->
  <div class="card-body">
    <table style="width: 100%;">
      <tbody style="text-align: center;">
        <tr>
          <td colspan="2" class="text-center">
            <img src="{{ asset('/assets/img/gg_logo.png') }}" alt="Card Logo"
                 class="img-fluid" style="margin: auto; height: 50px;">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <h6 class="text-center text-white" id="textPreview1"
                style="margin: 38px 0px;"
                v-text="card_name ? card_name : 'Card name will appear here'">
            </h6>
          </td>
        </tr>
        <tr>
          <td><h6 class="text-start text-white">Sample</h6></td>
          <td><h6 class="text-end text-white">Sample</h6></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

      </td>

      <!-- Back Side of Card -->
      <td style="width: 50%;">
        <div class="card card-custom mx-1 mt-3 p-3" :style="{ 'background': card_color }" id="colorPreview2" style="width: 320px;">
          <div class="before-left"></div>
          <div class="after-right"></div>
          <div class="card-body">
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <!-- Left Info Section -->
                  <td style="width: 55%;">
                    <table class="membership-details" style="width: 100%;">
                      <tbody>
                        <tr class="members_info"><td>NIC No:</td><td>-</td></tr>
                        <tr class="members_info"><td>Membership Type:</td><td id="textPreview2"></td></tr>
                        <tr class="members_info"><td>Membership No:</td><td>-</td></tr>
                        <tr class="members_info"><td>Blood Group:</td><td>-</td></tr>
                        <tr class="members_info"><td>Emergency No:</td><td>-</td></tr>
                        <tr class="members_info"><td>Date of Issue:</td><td>-</td></tr>
                        <tr class="members_info"><td>Validity:</td><td></td></tr>
                      </tbody>
                    </table>

                    <table class="membership-details mt-3" style="width: 100%;">
                      <tbody>
                        <tr class="members_info">
                          <td class="pe-4">Corporate Office: VG House, The Plaza, Suite 207, 2nd Floor, Khayaban-e-Iqbal, Block-9, Clifton, Karachi, Pakistan.</td>
                        </tr>
                        <tr class="members_info">
                          <td>Help Line: +9221-111-947-111</td>
                        </tr>
                        <tr class="members_info">
                          <td>Club Address: 01, Club Road, North Darbela, Platinum Seaview, Gwadar, Pakistan.</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>

                  <!-- Profile and Signature -->
                  <td style="width: 41%; text-align: center; position: relative; top: 10px;">
                    <img src="{{ asset('assets/img/profile.png') }}" alt="" style="width: 45%; height: 65px; margin: auto;">
                    <p class="members_info mt-1"></p>
                    <div class="bg-white mx-auto" style="height: 40px; width: 65%; border-radius: 3px;">
                      <img src="{{ asset('/assets/img/sign_logo.png') }}" alt="" class="img-fluid" style="height: 40px;">
                    </div>
                    <p class="members_info mt-1">SECRETARY<br>GWADAR GYMKHANA</p>
                  </td>

                  <!-- Instructional Text -->
                  <td style="width: 4%;">
                    <div class="bc-head-txt-label bc-head-icon-chrome_android">
                      Membership card is required for the use of <br>
                      facilities and services in Gwadar Gymkhana.
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
 </div>
          
        </main>
         
        <script>
          const app = Vue.createApp({
            data() {
              return {
                card_name: "{{ $cardType->card_name }}",
                card_color: "{{ $cardType->card_color }}",
                shade_color: "{{ $cardType->shade_color }}"
              }
            },
            methods: {
              async submit(e) {
                e.preventDefault();
                const response = await axios.put(route("api.card.update", route().params), { ...this.$data });
                if(response.data.status === "200") {
                  window.location = route("card-type.index");
                } 
              }
            },
            mounted() {
           
            }
          }).mount("#app");
        </script>
</x-layout.app>

