export const utils = {
    methods: {
        toastSuccess (message) {
            this.$toast.success(message, {
                position: "top-right",
                timeout: 3000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: true,
                hideProgressBar: false,
                closeButton: false,
                icon: "fa-solid fa-house",
                rtl: false
              });
        },

        toastError (message) {
            this.$toast.error(message, {
                position: "top-right",
                timeout: 5000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: true,
                hideProgressBar: false,
                closeButton: false,
                icon: "fa-solid fa-house",
                rtl: false
              });
        },
    },
}