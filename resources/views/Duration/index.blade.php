<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
  </style>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Manage Duration &amp; Fees
      </h2>
      <a @click="createNew" style="width: 10%; margin-bottom: 20px; text-align: center;" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Create
      </a>
      <div style="display: flex; justify-content: space-between;">
        <input v-model="search" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" style="width: 25%; margin-bottom: 20px;" placeholder="Search">
      </div>
      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Months</th>
            <th class="px-4 py-3">Fees</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          <tr v-for="duration in durations" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm" v-html="`${duration.months} Months`"></td>
            <td class="px-4 py-3 text-xs" v-html="`${duration.fee}/-`"></td>
            <td class="px-4 py-3">
              <div class="flex items-center space-x-4 text-sm">
                <button @click="editDuration(duration.id, duration.months, duration.fee)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </button>
                <button @click="deleteDuration(duration.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                  <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end" style="color: white; margin-top: 20px;">
      <nav aria-label="Table navigation">
        <ul class="inline-flex items-center">
          <li v-for="(link, index) in links">
            <button @click="changePage(link.url)" v-if="index === 0" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
              <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
            </button>
            <button @click="changePage(link.url)" v-else-if="index === links.length - 1" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
              <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
              </svg>
            </button>
            <button @click="changePage(link.url)" v-else v-text="link.label" :class="{ 'bg-purple-600 border-purple-600 rounded-md text-white': link.active === true, 'text-black': link.active != true }" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"></button>
          </li>
        </ul>
      </nav>
    </span>
  </main>
   
  <script>
    console.log(route('api.member.index'));
    const app = Vue.createApp({
      data() {
        return {
          durations: [],
          links: [],
          search: ""
        }
      },
      async mounted() {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }
        this.getContent(route("api.duration.index"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.duration.index", { keyword: newValue }));
        },
      },
      methods: {
        createNew() {
          Swal.fire({
            title: "Create Duration & Fee",
            html: `
              <input id="swal-input-username" type="number" class="swal2-input" placeholder="Duration(in Months)">
              <input id="swal-input-email" type="number" class="swal2-input" placeholder="Fee">
            `,
            showCancelButton: true,
            confirmButtonText: "Create",
            showLoaderOnConfirm: true,
            focusConfirm: false,
            preConfirm: async () => {
              const months = document.getElementById("swal-input-username").value.trim();
              const fee = document.getElementById("swal-input-email").value.trim();

              if (!months || !fee) {
                Swal.showValidationMessage("Please enter both duration and fee");
                return false;
              }

              try {
                const response = await axios.post(route("api.duration.create"), { months, fee });
                if(response.data.status === "200") {
                  window.location = route("duration.index");
                }
              } catch (error) {

              }
            },
            allowOutsideClick: () => !Swal.isLoading()
          })

        },
        editDuration(id, months, fees) {
          Swal.fire({
            title: "Edit Duration & Fee",
            html: `
              <input id="swal-input-username" value="${months}" type="number" class="swal2-input" placeholder="Duration(in Months)">
              <input id="swal-input-email" value="${fees}" type="number" class="swal2-input" placeholder="Fee">
            `,
            showCancelButton: true,
            confirmButtonText: "Update",
            showLoaderOnConfirm: true,
            focusConfirm: false,
            preConfirm: async () => {
              const months = document.getElementById("swal-input-username").value.trim();
              const fee = document.getElementById("swal-input-email").value.trim();

              if (!months || !fee) {
                Swal.showValidationMessage("Please enter both duration and fee");
                return false;
              }

              try {
                const response = await axios.put(route("api.duration.update", { duration: id }), { months, fee });
                if(response.data.status === "200") {
                  window.location = route("duration.index");
                }
              } catch (error) {
                
              }
            },
            allowOutsideClick: () => !Swal.isLoading()
          })

        },
        debounce(func, delay = 300) {
          let timeoutId;
          return function (...args) {
            const context = this;
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
              func.apply(context, args);
            }, delay);
          };
        },
        changePage(url) {
          this.getContent(url);
        },
        async getContent(url) {
          const response = await axios.get(url);
          this.durations = response.data.data;
          this.links = response.data.meta.links;
        },
        editClub(id) {
          window.location = route('club.update', {club: id});
        },
        async deleteDuration(id) {
          Swal.fire({
            title: "Do you want to delete it permanently?",
            showCancelButton: true,
            confirmButtonText: "Delete",
          }).then(async (result) => {
            if (result.isConfirmed) {
              const response = await axios.delete(route("api.duration.delete", { duration: id }));
              if(response.data.status === "200") {
                this.durations = this.durations.filter(duration => duration.id !== id);
              } 
            }
          });
        }
      }
    }).mount("#app");
  </script>
</x-layout.app>

