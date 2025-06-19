<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
    }
    .download-card {
      padding: 30px;
      border-radius: 16px;
      background-color: white;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.08);
      text-align: center;
      width: 100%;
      max-width: 400px;
    }
    .btn-download {
      font-size: 1rem;
      padding: 10px 20px;
      border-radius: 10px;
      transition: all 0.2s ease-in-out;
    }
    .btn-download:hover {
      transform: scale(1.05);
    }
    @media (max-width: 576px) {
      h2 {
        font-size: 1.3rem;
      }
      .btn-download {
        width: 100%;
        font-size: 1rem;
      }
    }

    body {
        overflow-y: scroll;
        height: 100%;
      }
      .loader {
        width: 20px;
        height: 20px;
        border: 5px solid #FFF;
        border-bottom-color: transparent;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }
        .loader.big {
          width: 40px;
          height: 40px;
        }
        .loader.small {
          width: 10px;
          height: 10px;
        }
        .loader.purple {
          border: 5px solid #7e3af2;
          border-bottom-color: transparent;
        }
  </style>
  @routes
</head>
<body>
  <div id="app" class="d-flex justify-content-center align-items-center" style="height: 100vh; padding: 15px;">
    <div class="download-card" v-if="!is_fetching_user">
        <h5 class="text-muted mb-4">Payment Schedule of <br> <span v-text="user.member_name"></span></h5>
        <button class="btn btn-primary btn-download d-flex align-items-center justify-content-center gap-2 w-100" @click="downloadPDF" :disabled="isLoading">
        <span v-if="isLoading">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Downloading...
        </span>
        <span v-else>
          <i class="fas fa-file-pdf"></i> Download PDF
        </span>
      </button>
      <p class="text-muted mt-2" style="font-size: 10px;">Downloading may take 1–2 minutes</p>
    </div>
    <div v-else>
        <span class="loader purple big">&nbsp;</span>
    </div>
  </div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    const { createApp } = Vue;
    createApp({
      data() {
        return {
            user: "",
            is_fetching_user: true,
        }
      },
      async mounted() {
        try {
            const member = await axios.get(route("api.member.get", route().params));
            this.user = member.data.data;
        } catch(e) {
            
        } finally {
            this.is_fetching_user = false;
        }
      },
      methods: {
        async downloadPDF() {
          const fileUrl = `https://gwadargymkhana.com.pk/mailer/mailer/generate_recovery_sheet.php?id=${this.user.id}`;
          this.isLoading = true;
          try {
            const response = await fetch(fileUrl);
            if (!response.ok) throw new Error("Failed to fetch PDF");

            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${this.user.name}.pdf`;
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
          } catch (error) {
            alert("Something went wrong while downloading the file.");
            console.error(error);
          } finally {
            this.isLoading = false;
          }
        }
      }
    }).mount("#app");
  </script>
</body>
</html>