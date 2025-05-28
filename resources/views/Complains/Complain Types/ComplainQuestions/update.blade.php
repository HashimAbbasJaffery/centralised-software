<x-layout.app>
    <main class="h-full pb-16" id="app">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">Update Complain Questions</h2>
         <form @submit="update">
            <div class="step-form px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
  <h5 class="dark:text-gray-200" style="margin-bottom: 20px;">Personal Information</h5>

  <div style="display: flex; column-gap: 20px;">
    <!-- Member's Name -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Questions</span>
        <input
          data-message="member_field_message"
          class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                     focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                     dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          v-model="question"
        >
        <span class="member_field_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Questions's field is required
        </span>
      </label>
    </div>

    <!-- Date of Birth -->
    <div style="width: 50%;">
      <label class="block text-sm" style="margin-bottom: 20px;">
        <span class="text-gray-700 dark:text-gray-400">Relevancy</span>
        <select v-model="relevancy" data-message="gender_field_message" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
          <option value="1">Relevant</option>
          <option value="0">Irrelevant</option>
        </select>
        <span class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
          Paid Amount field is required
        </span>
      </label>
    </div>
  </div>
  <div style="width: 100%;" v-if="relevancy != 1">
    <label class="block text-sm" style="margin-bottom: 20px;">
      <span class="text-gray-700 dark:text-gray-400">Answer</span>
      <textarea v-model="answer" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"></textarea>
      <span class="date_of_birth_field_message step_1_message text-xs text-red-600 dark:text-red-400" style="display: none;">
        Paid Amount field is required
      </span>
    </label>
  </div>
  <button class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Submit
    </button>
</div>
</form>

        </main>
    
 
    <script>
const app = Vue.createApp({
    data() {
        return {
          question: "{{ $complainQuestion->question }}",
          relevancy: {{ $complainQuestion->is_relevant }},
          answer: "{{ $complainQuestion->answer }}"
        }
    },
    watch: {
        async selectedId(newValue) {
            const response = await axios.get(route("api.member.getById", { member: newValue }));
            this.member_name = response.data.member_name;
        }
    },
  methods: {
    async update(e) {
      e.preventDefault();
      const response = await axios.put(route("api.complains.complain-type.questions.update", route().params), {
        answer: this.answer,
        is_relevant: this.relevancy,
        question: this.question,
      });
      if(response.data.status === "200") {
        window.location = route("complain.complain-types.questions.index", { complainType: response.data.data });
      }
    },
    async submit(e) {
        e.preventDefault();

        const response = await axios.post(
            route("api.complains.complain-type.questions.create", route().params),
            { 
                question: this.question,
                is_relevant: this.relevancy,
                answer: this.answer
            }
        );
        console.log(response);
        if(response.data.status === "200") {
            window.location = route("complain.complain-types.questions.index", route().params);
        }
        
    },
    select(id) {
        this.selectedId = id;
        Swal.close();
    },
    async showMembers() {
        this.is_fetching_members = true;
        const self = this;
      try {
        const response = await axios.get(route('api.member.all'));
        const members = response.data.data;
        
        let rows = members.map(member => `
          <tr>
            <td>${member.member_name}</td>
            <td>${member.cnic_passport}</td>
            <td>${member.membership_number}</td>
            <td>${member.file_number}</td>
            <td>${member.residential_address}</td>
            <td>
                <button data-member='${member.id}' class="select-member-button px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                  Select
                </button>
            </td>
          </tr>
        `).join('');

        Swal.fire({
          title: 'Members List',
          html: `
            <table id="swal-datatable" class="display" style="width:100%; text-align: left; font-size: 13px;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>CNIC</th>
                  <th>Membership #</th>
                  <th>File No</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                ${rows}
              </tbody>
            </table>
          `,
          width: 1000,
          didOpen: () => {
            $('#swal-datatable').DataTable();

              document.querySelectorAll('.select-member-button').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const memberData = JSON.parse(e.currentTarget.getAttribute('data-member'));
                    console.log(memberData);
                    self.select(memberData);
                });
            });
          }
        });

      } catch (error) {
        console.error("Error fetching members:", error);
        Swal.fire('Error', 'Could not load members.', 'error');
      } finally {
        this.is_fetching_members = false;
      }
    }
  }
}).mount("#app");
</script>
</x-layout.app>