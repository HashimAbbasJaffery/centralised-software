<x-layout.app>
    <main class="h-full pb-16" id="app" :key="key">
        <div class="container px-6 mx-auto grid">
            <h2 class="mt-6 mb-3 text-2xl font-semibold text-gray-700 dark:text-gray-200">View Payment Schedule</h2>
            <a @click="showMembers" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" style="margin-top: 20px; width: 150px; margin-bottom: 20px; text-align: center;">Select Member</a>
            <div class="member-info" v-if="member.id">
                <div class="container px-6 mx-auto grid mx-6" style="border-radius: 10px; background: rgba(26, 28, 35, var(--bg-opacity);">
                    <table style="color: white;">
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Name: <span v-text="member.member_name"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member File No: <span v-text="member.file_number"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Membership Number: <span v-text="member.membership_number"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member CNIC: <span v-text="member.cnic_passport"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Phone No: <span v-text="member.phone_number"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Alt Phone No <span v-text="member.alternate_ph_number"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Member Address: <span v-text="member.residential_address"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="container px-6 mx-auto grid mx-6" style="margin-top: 20px; border-radius: 10px; background: rgba(26, 28, 35, var(--bg-opacity);">
                    <table style="color: white;">
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Membership Type: <span v-text="member.membership.card_name"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Form Fee: <span v-text="member.form_fee.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Processing Fee: <span v-text="member.processing_fee.toLocaleString()"></span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">First Payment: <span v-text="member.first_payment.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Total Installment: <span v-text="member.total_installment.toLocaleString()"></span></td>
                            <td style="padding: 10px; color: rgb(158, 158, 158)">Months: <span v-text="member.installment_month"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="member-installment" style="margin-top: 20px; border-radius: 10px; overflow-x: scroll;" v-if="member.id">
                <div class="container grid" style="border-radius: 10px;">
                    <table class="w-full whitespace-no-wrap" style="margin-right: 20px;">
                  <thead>
                    <tr style="font-size: 10px;" class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                      <th class="px-4 py-3">Month</th>
                      <th class="px-4 py-3">Due <br> Amount</th>
                      <th class="px-4 py-3">Due <br> Date</th>
                      <th class="px-4 py-3">Payment <br> Description</th>
                      <th class="px-4 py-3">Current <br> Month <br> Payable</th>
                      <th class="px-4 py-3">Late <br> Month <br> Charges</th>
                      <th class="px-4 py-3">Payable</th>
                      <th class="px-4 py-3">Paid</th>
                      <th class="px-4 py-3">Due B/F</th>
                      <th class="px-4 py-3">Balance</th>
                      <th class="px-4 py-3">Total <br> Balance</th>
                      <th class="px-4 py-3">Add</th>
                      <th class="px-4 py-3">Remove</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr class="text-gray-700 dark:text-gray-400" v-for="(row, index) in rows" :key="row.id">
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input v-model="row.month" style="font-size: 10px;" type="date" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" :value="due_amounts[index]" style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="date" v-model="row.due_date" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.payment_description" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.current_month_payable" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.late_month_charges" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" :value="sumAndSave(row.current_month_payable, parseInt(row.late_month_charges) + parseInt(due_amounts[index]), row.id, 'payable')" style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.paid" style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" :value="subtractAndSave(row.payable, row.paid, row.id, 'due') < 0 ? 0 : subtractAndSave(row.payable, row.paid, row.id, 'due') " style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" :value="balances[index]" readonly style="font-size: 10px;" class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px; padding-bottom: 10px; padding-top: 10px;">
                            <input type="text" v-model="row.total_balance" :value="subtractAndSave(balances[index], parseInt(row.paid) - parseInt(row.late_month_charges), row.id, 'total_balance')" readonly style="font-size: 10px;" readonly class="step_1 block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        </td>
                        <td style="padding-left: 15px;">
                            <button @click="addRow" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                +
                            </button>
                        </td>
                        <td style="padding-left: 15px;">
                            <button @click="deleteRow(row.id, index)" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                -
                            </button>
                        </td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div>
            </div>
            <button @click="saveInDatabase(member.id)" style="margin-top: 10px; margin-bottom: 10px;" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>
    </main>
    
 
    <script>
const app = Vue.createApp({
    data() {
        return {
            selectedId: "",
            member: [],
            balances: [],
            due_amounts: [0],
            rows: [
                {
                    id: 1,
                    month: "",
                    due_amount: "",
                    due_date: "",
                    payment_description: "",
                    current_month_payable: "",
                    late_month_charges: "",
                    payable: "",
                    paid: "",
                    due: "",
                    balance: "",
                    total_balance: ""
                }
            ],
            key: 1
        }
    },
    watch: {
        async selectedId(newValue) {
            const response = await axios.get(route("api.member.getById", { member: newValue }));
            const second_response = await axios.get(route("api.recovery.get", { member: newValue }));
            
            if(second_response.data.data.length > 0) {
                const recoveryRows = this.denormalize(second_response.data.data);
                this.rows = recoveryRows;
            }


            this.member = response.data;
            const member = this.member;
            this.balances[0] = member.form_fee + member.processing_fee + member.first_payment + member.total_installment;
        }
    },
  methods: {
    denormalize(rows) {
        rows.forEach(row => {
            row["late_month_charges"] = row["late_payment_charges"];
            row["balance"] = row["main_balance"]; 
            this.due_amounts.push(row["due_amount"]);
            this.balances.push(row["balance"])
        });

        return rows;
    },
    async saveInDatabase(id) {
        this.rows.forEach((row, index) => {
            row.balance = this.balances[index];
            row.due_amount = this.due_amounts[index];
        });
        
        const request = await axios.post(route("recovery.create", { member: id }), {rows: this.rows});
        console.log(request); 
    },
    sumAndSave(value1, value2, id, key) {
        const row = this.rows.filter(row => row.id == id);
        console.log(key);
        const value = parseInt(value1) + parseInt(value2);
        row[0][key] = value;
        return isNaN(value) ? '' : value;
    },
    subtractAndSave(value1, value2, id, key) {
        const row = this.rows.filter(row => row.id == id);
        const value = parseInt(value1) - parseInt(value2);
        row[0][key] = value;
        return isNaN(value) ? '' : value;   
    },
    addRow() {
        this.balances.push(this.rows[this.rows.length - 1].total_balance);

        this.due_amounts.push(this.rows[this.rows.length - 1].due < 0 ? 0 : this.rows[this.rows.length - 1].due);
        this.rows.push({
            id: this.rows.length + 1,
            month: "",
            due_amount: "",
            due_date: "",
            payment_description: "",
            current_month_payable: "",
            late_month_charges: "",
            payable: "",
            paid: "",
            due: "",
            balance: "",
            total_balance: ""
        });
    },
    deleteRow(id, index) {
        this.rows = this.rows.filter(row => row.id != id);
        this.balances.splice(index, 1);
        this.due_amounts.splice(index, 1);
        console.log(this.balances);
    },
    select(id) {
        this.selectedId = id;
        Swal.close();
    },
    async showMembers() {
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
      }
    }
  }
}).mount("#app");
</script>
</x-layout.app>