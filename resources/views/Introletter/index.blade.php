<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
    
.paginate_button { 
  border-radius: 0.375rem !important;     /* rounded-md */
  color: #ffffff !important;              /* text-white */
  padding: 0.25rem 0.75rem !important;    /* py-1 px-3 */
  outline: none !important;               /* focus:outline-none */
  transition: box-shadow 0.2s ease, background-color 0.2s ease !important;
}
  </style>
  
  <script src="https://kit.fontawesome.com/231b67747d.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
        <div style="display: flex; align-items: center; gap: 10px;">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Manage Introduction Letters
      </h2>
        <a href="https://gwadargymkhana.com.pk/introletter/" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Introduction Letter Link</a>
        </div>
      
      
      {{ $dataTable->table() }}
    </div>
    
  </main>
   
  <script>
    console.log(route('api.member.index'));
    const app = Vue.createApp({
      data() {
        return {
          introletters: [],
          links: [],
          search: ""
        }
      },
      async mounted() {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }
        this.getContent(route("api.introletter.index"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.introletter.index", { keyword: newValue }));
        },
      },
      methods: {
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
          console.log(response);
          this.introletters = response.data.data;
          this.links = response.data.meta.links;
        },
        editMember(id) {
          window.location = route('member.updated', { member: id });
        },
        getInvoice(id) {
          window.location = route("introletter.invoice", { introletter: id });
        },
        async deleteIntroletter(id) {

          Swal.fire({
            title: "Do you want to move it in trash?",
            showCancelButton: true,
            confirmButtonText: "Delete",
          }).then(async (result) => {
            if (result.isConfirmed) {
              const response = await axios.delete(route("api.introletter.delete", { introletter: id }));
              console.log(response);
              if(response.data.status === "200") {
                this.introletters = this.introletters.filter(introletter => introletter.id !== id);
              } 
            }
          });
        }
      }
    }).mount("#app");
  </script>
  
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
</x-layout.app>

