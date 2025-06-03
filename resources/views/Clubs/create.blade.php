<x-layout.app>
<style>
  .vs__selected {
    color: black;
  }
  .v-select {
    padding: 3px;
  }
</style>
<script src="https://unpkg.com/vue@2"></script>
        <main id="app" class="h-full pb-16 overflow-y-auto">
          <!-- Remove everything INSIDE this div to a really blank page -->
          
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add Club name
            </h2>
            <form @submit="submit">
              <div class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div style="display: flex; column-gap: 20px;">
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Club Name</span>
                      <input v-model="club_name" type="text" data-message="cnic_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                    </label>
                  </div>
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Countries</span>
                      <v-select class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" :options="options" label="country" v-model="selectedCountry"></v-select>
                    </label>
                  </div>
                  <div style="width: 33.33%;">
                    <label class="block text-sm" style="margin-bottom: 20px;">
                      <span class="text-gray-700 dark:text-gray-400">Cities</span>
                      <v-select :options="paginated" label="" :filterable="false" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" @search="onSearch" v-model="selectedCity"></v-select>
                    </label>
                  </div>
                </div>
                <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Create
                </button>
              </div>
            </form>
 </div>
          
        </main>
         
        <script>
Vue.component('v-select', VueSelect.VueSelect)

new Vue({
  el: '#app',
  data: {
    options: [],
    cities: [],
    selectedCountry: "",
    selectedCity: "",
    club_name: "",
    offset: 0,
    limit: 10,
    search: "",
    currentStep: 0,
    steps: document.querySelectorAll(".step")
  },
  async mounted() {
      const response = await axios.get("https://countriesnow.space/api/v0.1/countries/");
      this.options = response.data.data;
      
        const input = document.querySelector("#phone");
  const iti = window.intlTelInput(input, {
    loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
  });

    const phone = document.getElementById("phone");
    
    const updatePhoneNumber = () => {
      const countryData = iti.getSelectedCountryData();
      const country_code = document.getElementById("country_code");
      const phone_number = document.getElementById("phone_number");
      country_code.value = countryData.dialCode;
      phone_number.value = iti.getNumber().replace(/^\+/, '');
    }

    input.addEventListener("countrychange", function () {
        updatePhoneNumber();
    });
    
    phone.addEventListener("input", function() {
        updatePhoneNumber();
    })
    
    
    document.getElementById("wizardForm").addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Form submitted successfully!");
    });

    this.showStep(this.currentStep);
  },
  computed: {
  filtered() {
      return this.cities.filter((country) =>
        country.toLocaleLowerCase().includes(this.search.toLocaleLowerCase())
      )
    },
    paginated() {
      return this.filtered.slice(this.offset, this.limit + this.offset)
    },
    hasNextPage() {
      const nextOffset = this.offset + this.limit
      return Boolean(
        this.filtered.slice(nextOffset, this.limit + nextOffset).length
      )
    },
    hasPrevPage() {
      const prevOffset = this.offset - this.limit
      return Boolean(
        this.filtered.slice(prevOffset, this.limit + prevOffset).length
      )
    },
  },
  watch: {
      async selectedCountry(newValue) {
          const response = await axios.post("https://countriesnow.space/api/v0.1/countries/cities", { country: newValue.country });
          this.cities = response.data.data;
      }
  },
  methods: {
    async submit(e) {
      e.preventDefault();
      const response = await axios.post(route("api.club.create", { club_name: this.club_name, country: this.selectedCountry.country, city: this.selectedCity }));
      console.log(response.data.status); 
      if(response.data.status === "200") {
        window.location = route("club.index");
      }
    },
    onSearch(query) {
      this.search = query
      this.offset = 0
    },
    showStep(index) {
        this.steps.forEach((step, i) => {
            step.classList.toggle("active", i === index);
        });
        document.getElementById("prevBtn").disabled = index === 0;
        document.getElementById("nextBtn").textContent = index === steps.length - 1 ? "Submit" : "Next";
    },
    validateStep() {
        const currentInputs = steps[this.currentStep].querySelectorAll("input");
        let valid = true;
        currentInputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add("is-invalid");
                valid = false;
            } else {
                input.classList.remove("is-invalid");
            }
        });
        console.log(valid);
        return valid;
    },
    nextPrev(n) {
        if (n === 1 && !this.validateStep()) return;
        this.currentStep += n;
        if (this.currentStep >= steps.length) {
            document.getElementById("wizardForm").submit();
            return;
        }
        this.showStep(currentStep);
    }
  },
})
</script>
</x-layout.app>

