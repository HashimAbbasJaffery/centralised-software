<x-layout.app>
    <script src="https://kit.fontawesome.com/3a7e8b6e65.js" crossorigin="anonymous"></script>
    <style>
        .iti {
            width: 100%;
        }

        input[type='checkbox'] {
            width: 12px;
            height: 12px;
        }
    </style>
    <main id="app" class="h-full pb-16 overflow-y-auto">
        <!-- Remove everything INSIDE this div to a really blank page -->

        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Manage Not Eligible Leads
            </h2>
            <a href="{{ route('lead.create') }}" style="width: 10%; margin-bottom: 20px; text-align: center;"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create
            </a>
            <div style="display: flex; justify-content: space-between;">
                <input v-model="search"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    style="width: 25%; margin-bottom: 20px;" placeholder="Search">
            </div>
            <table v-if="leads.length > 0 && !is_fetching" class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Lead Name</th>
                        <th class="px-4 py-3">Phone Number</th>
                        <th class="px-4 py-3">Re-Eligibility Link</th>
                        <th class="px-4 py-3">Valid Until</th>
                        <th class="px-4 py-3">Copy</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="lead in leads" class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm" v-text="lead.lead_name"></td>
                        <td class="px-4 py-3 text-sm" v-text="lead.phone_number"></td>
                        <td class="px-4 py-3 text-sm" v-text="lead.url"></td>
                        <td class="px-4 py-3 text-sm">@{{ formatDate(lead.expires_at) }}</td>
                        <td class="px-4 py-3">
                            <svg v-show="copied !== lead.id" @click="copyLink(lead.url, lead.id)" class="w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M480 400L288 400C279.2 400 272 392.8 272 384L272 128C272 119.2 279.2 112 288 112L421.5 112C425.7 112 429.8 113.7 432.8 116.7L491.3 175.2C494.3 178.2 496 182.3 496 186.5L496 384C496 392.8 488.8 400 480 400zM288 448L480 448C515.3 448 544 419.3 544 384L544 186.5C544 169.5 537.3 153.2 525.3 141.2L466.7 82.7C454.7 70.7 438.5 64 421.5 64L288 64C252.7 64 224 92.7 224 128L224 384C224 419.3 252.7 448 288 448zM160 192C124.7 192 96 220.7 96 256L96 512C96 547.3 124.7 576 160 576L352 576C387.3 576 416 547.3 416 512L416 496L368 496L368 512C368 520.8 360.8 528 352 528L160 528C151.2 528 144 520.8 144 512L144 256C144 247.2 151.2 240 160 240L176 240L176 192L160 192z" />
                            </svg>
                            <span v-show="copied === lead.id" class="ml-2 text-sm">Copied ✓</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else-if="!is_fetching" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Enrollment Links Not Found!
                </p>
            </div>
            <span v-if="is_fetching" class="loader big purple" style="margin: auto;"></span>
        </div>
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end" style="color: white; margin-top: 20px;">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    <li v-for="(link, index) in links">
                        <button @click="changePage(link.url)" v-if="index === 0"
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Previous">
                            <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button @click="changePage(link.url)" v-else-if="index === links.length - 1"
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Next">
                            <svg class="w-4 h-4 fill-current text-black" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                        <button @click="changePage(link.url)" v-else v-text="link.label"
                            :class="{
                                'bg-purple-600 border-purple-600 rounded-md text-white': link.active ===
                                    true,
                                'text-black': link.active != true
                            }"
                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"></button>
                    </li>
                </ul>
            </nav>

        </span>
    </main>

    <script>
        console.log(route('api.leads'));
        const app = Vue.createApp({
            data() {
                return {
                    leads: [],
                    links: [],
                    search: "",
                    is_fetching: true,
                    copied: null,
                }
            },
            async mounted() {
                const savedData = JSON.parse(localStorage.getItem('formData'));
                if (savedData) {
                    this.$data = Object.assign(this.$data, savedData);
                }

                // Checking if the url is there is session storage
                this.getContent(route("api.leads"));
            },
            watch: {
                search(newValue) {
                    this.getContent(route("api.leads", {
                        keyword: newValue
                    }));
                },
            },
            methods: {
                debounce(func, delay = 300) {
                    let timeoutId;
                    return function(...args) {
                        const context = this;
                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(() => {
                            func.apply(context, args);
                        }, delay);
                    };
                },
                changePage(url) {
                    if (!url) return;

                    this.parentCheckbox = false;
                    this.getContent(url);
                },
                async getContent(url) {
                    this.is_fetching = true;
                    const response = await axios.get(url);
                    console.log(response);
                    sessionStorage.setItem("url", url != null ? url : "");
                    this.leads = response.data.data;
                    this.links = response.data.meta.links;
                    this.is_fetching = false;
                },
                copyLink(url, id) {
                    navigator.clipboard.writeText(url).then(() => {

                        this.copied = id;

                        // hide after 2 seconds
                        setTimeout(() => {
                            if (this.copied === id) {
                                this.copied = null;
                            }
                        }, 1000);

                    }).catch(() => this.fallbackCopyText(url));
                },
                formatDate(dateString) {
                    if (!dateString) return "-";

                    const date = new Date(dateString);

                    return date.toLocaleString("en-US", {
                        day: "2-digit",
                        month: "short",
                        year: "numeric",
                        hour: "2-digit",
                        minute: "2-digit",
                        hour12: true
                    });
                }
            }
        }).mount("#app");
    </script>
</x-layout.app>
