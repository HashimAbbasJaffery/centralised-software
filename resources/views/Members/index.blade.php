<x-layout.app>
  <style>
    .iti {
      width: 100%;
    }
    input[type='checkbox'] {
      width: 12px;
      height: 12px;
    }
    

.progress-container {
  width: 100%;
  height: 20px;
  background-color: #f3f3f3;
  border-radius: 10px;
  overflow: hidden;
  position: relative;
}

.progress-bar {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(
    45deg,
    #dc2626 25%,
    #b91c1c 25%,
    #b91c1c 50%,
    #dc2626 50%,
    #dc2626 75%,
    #b91c1c 75%,
    #b91c1c 100%
  );
  background-size: 40px 40px;
  animation: moveStripes 1s linear infinite;
}

@keyframes moveStripes {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 40px 0;
  }
}
.paginate_button { 
  border-radius: 0.375rem !important;     /* rounded-md */
  color: #ffffff !important;              /* text-white */
  padding: 0.25rem 0.75rem !important;    /* py-1 px-3 */
  outline: none !important;               /* focus:outline-none */
  transition: box-shadow 0.2s ease, background-color 0.2s ease !important;
}

  </style>
  <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
  <main id="app" class="h-full pb-16 overflow-y-auto">
    <!-- Remove everything INSIDE this div to a really blank page -->
    
    <div class="container px-6 mx-auto grid">
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
      >
        Manage Members
      </h2>
      <div style="display: flex; column-gap: 10px;">
        <a 
  href="{{ route('member.create') }}" 
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-bottom: 16px;
    margin-right: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #8b5cf6, #7c3aed); /* purple gradient */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(124, 58, 237, 0.35);
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(to right,#7c3aed,#5b21b6)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#8b5cf6,#7c3aed)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #ddd6fe'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  Create
</a>

<a 
  @click="createToWati" 
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    margin-bottom: 16px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #10b981, #059669); /* green gradient */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(16, 185, 129, 0.35);
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(to right,#059669,#047857)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#10b981,#059669)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #a7f3d0'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  Export for Wati broadcast 
  <sub style="font-size: 0.7rem; opacity: 0.85;">(defaulter and cancelled excluded)</sub>
</a>

   
  
      @if($setting)
    <a 
  href="{{ $setting->google_drive_link }}" 
  target="_blank"
  style="
    margin-bottom: 20px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #1a1a1a; /* softer text for light button */
    text-decoration: none;
    background: linear-gradient(90deg, #a7f3d0, #fde68a, #bfdbfe); /* light green → yellow → blue */
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1); /* soft subtle shadow */
    transition: all 0.3s ease;
  "
  onmouseover="this.style.background='linear-gradient(90deg, #6ee7b7, #fcd34d, #93c5fd)'; this.style.transform='translateY(-2px) scale(1.04)';"
  onmouseout="this.style.background='linear-gradient(90deg, #a7f3d0, #fde68a, #bfdbfe)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #93c5fd'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  <i class="fa-brands fa-google-drive" style="font-size: 1rem; margin-right: 10px; color: #1a73e8;"></i>
  Link
</a>

      @endif
            <button
  @click="exportToExcel"
  :disabled="isExporting"
  style="
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    margin-bottom: 16px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    background: linear-gradient(to right, #22c55e, #16a34a); /* green gradient */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4); /* green shadow */
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
  "
  onmouseover="this.style.background='linear-gradient(to right,#16a34a,#15803d)'; this.style.transform='translateY(-2px) scale(1.05)';"
  onmouseout="this.style.background='linear-gradient(to right,#22c55e,#16a34a)'; this.style.transform='none';"
  onfocus="this.style.outline='2px solid #bbf7d0'; this.style.outlineOffset='3px';"
  onblur="this.style.outline='none';"
>
  <span v-if="isExporting" class="inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
  <span v-text="isExporting ? 'Exporting...' : 'Export to Excel'"></span>
</button>

      </div>
 
      {{ $dataTable->table() }}
 
    </div>
   
  </main>
   
  <script>
    console.log(route('api.member.index'));
    const app = Vue.createApp({
      data() {
        return {
          members: [],
          links: [],
          search: "",
          membershipFilter: "",
          membershipTypes: [],
          parentCheckbox: "",
          is_fetching: true,
          isExporting: false,
          child_checkbox: []
        }
      },
      created() {
        const checked_checkboxes = document.querySelectorAll('.child-checkboxes');
        checked_checkboxes.forEach(checkbox => {
          checked_checkboxes.checked = false;
        });
      },
      async mounted() {
        const savedData = JSON.parse(localStorage.getItem('formData'));
        if (savedData) {
          this.$data = Object.assign(this.$data, savedData);
        }

        // Fetch membership types from database
        await this.getMembershipTypes();
        
        // Checking if the url is there is session storage
        this.getContent(route("api.member.index"));
      },
      watch: {
        search(newValue) {
          this.getContent(route("api.member.index", { keyword: newValue, membership_type: this.membershipFilter }));
        },
        membershipFilter(newValue) {
          this.getContent(route("api.member.index", { keyword: this.search, membership_type: newValue }));
        },
        parentCheckbox(newValue) {
          const child_checkboxes = document.querySelectorAll(".child-checkboxes");
          child_checkboxes.forEach(checkbox => {
            if(!newValue) this.child_checkbox = [];
            else this.child_checkbox.push(checkbox.value);
          });
        }
      },
      methods: {
        getFamilySheet(id) {
          window.location = route("download.family-sheet", { member: id });
        },
        async createToWati() {
          const response = await axios.get(route('api.valid.member'));
          const members = response.data.data;
          const header = "Name,CountryCode,Phone,AllowBroadcast,AllowSMS,Attribute 1,Attribute 2\n";
          const rows = members.map(row => `M - ${row.member_name},${row.phone_number_code},${row.phone_number_without_code},TRUE,TRUE`).join("\n");
          const csvContent = header + rows;

          // Create download link
          const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
          const url = URL.createObjectURL(blob);

          const link = document.createElement("a");
          link.setAttribute("href", url);
          link.setAttribute("download", `${(new Date()).toISOString().split("T")[0]}.csv`);
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        },
        async saveInGoogleDrive() {
          const response = await axios.post(route("api.member.save.google.drive"));
          console.log(response);
        },
        backCard() {
          window.location = route("card.back", { members: this.child_checkbox });
        },
        frontCard() {
          window.location = route("card.front", { members: this.child_checkbox })
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
          this.parentCheckbox = false;
          this.getContent(url);
        },
        async getMembershipTypes() {
          try {
            const response = await axios.get(route("api.card.types"));
            this.membershipTypes = response.data.data || [];
          } catch (error) {
            console.error('Error fetching membership types:', error);
            this.membershipTypes = [];
          }
        },
        async getContent(url) {
          this.is_fetching = true;
          const response = await axios.get(url);
          sessionStorage.setItem("url", url != null ? url : "");
          this.members = response.data.data;
          this.links = response.data.meta.links;
          this.is_fetching = false;
        },
        editMember(id) {
          window.location = route('member.updated', { member: id });
        },
        getMember(id) {
          window.location = route('member.get', { member: id });
        },
        async deleteMember(id) {

          Swal.fire({
            title: "Do you want to move it in trash?",
            showCancelButton: true,
            confirmButtonText: "Delete",
          }).then(async (result) => {
            if (result.isConfirmed) {
              const response = await axios.delete(route("api.member.delete", { member: id }));
              if(response.data.status === "200") {
                this.members = this.members.filter(member => member.id !== id);
              } 
            }
          });
        },
        async exportToExcel() {
          this.isExporting = true;
          try {
            const params = new URLSearchParams();
            if (this.search) params.append('keyword', this.search);
            if (this.membershipFilter) params.append('membership_type', this.membershipFilter);
            
            const url = route("api.member.export") + (params.toString() ? '?' + params.toString() : '');
            
            // Use axios to get the file with proper authentication
            const response = await axios.get(url, {
              responseType: 'blob',
              headers: {
                'Accept': 'text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
              }
            });
            
            // Create blob and download
            const blob = new Blob([response.data], { type: 'text/csv' });
            const downloadUrl = window.URL.createObjectURL(blob);
            
            // Determine filename from response headers or use default
            const contentDisposition = response.headers['content-disposition'];
            let filename = 'members.csv';
            if (contentDisposition) {
              const filenameMatch = contentDisposition.match(/filename="(.+)"/);
              if (filenameMatch) {
                filename = filenameMatch[1];
              }
            }
            
            // Create download link
            const link = document.createElement('a');
            link.href = downloadUrl;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Clean up the URL object
            window.URL.revokeObjectURL(downloadUrl);
          } catch (error) {
            console.error('Error exporting to Excel:', error);
            alert('Error exporting data. Please try again.');
          } finally {
            this.isExporting = false;
          }
        }
      }
    }).mount("#app");
  </script>
  @push('scripts')
      {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  @endpush
</x-layout.app>

