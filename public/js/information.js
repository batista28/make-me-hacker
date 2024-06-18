class Accordion {
    constructor(el) {
        this.el = el;
        this.summary = el.querySelector("summary");
        this.content = el.querySelector(".faq-content");
        this.expandIcon = this.summary.querySelector(".expand-icon");
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.summary.addEventListener("click", (e) => this.onClick(e));
    }

    onClick(e) {
        e.preventDefault();
        this.el.style.overflow = "hidden";

        //Al hacer click cambiamos su estado
        if (this.isClosing || !this.el.open) {
            this.open();
        } else if (this.isExpanding || this.el.open) {
            this.shrink();
        }
    }

    shrink() {
        this.isClosing = true;

        //Al cerrarlo lo volvemos al tamaño pequeño
        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${this.summary.offsetHeight}px`;

        //Cancelamos la animacion (lo volvemos al tamaño original)
        if (this.animation) {
            this.animation.cancel();
        }

        //Aumentamos su tamaño
        this.animation = this.el.animate(
            {
                height: [startHeight, endHeight],
            },
            {
                duration: 400,
                easing: "ease-out",
            }
        );

        this.animation.onfinish = () => {
            this.expandIcon.setAttribute("src", "assets/plus.svg");
            return this.onAnimationFinish(false);
        };
        this.animation.oncancel = () => {
            this.expandIcon.setAttribute("src", "assets/plus.svg");
            return (this.isClosing = false);
        };
    }

    //Lo abrimos
    open() {
        this.el.style.height = `${this.el.offsetHeight}px`;
        this.el.open = true;
        window.requestAnimationFrame(() => this.expand());
    }

    //Hacemos que se expanda
    expand() {
        this.isExpanding = true;

        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${
            this.summary.offsetHeight + this.content.offsetHeight
        }px`;

        if (this.animation) {
            this.animation.cancel();
        }

        this.animation = this.el.animate(
            {
                height: [startHeight, endHeight],
            },
            {
                duration: 350,
                easing: "ease-out",
            }
        );

        this.animation.onfinish = () => {
            this.expandIcon.setAttribute("src", "images/information/minus.svg");
            return this.onAnimationFinish(true);
        };
        this.animation.oncancel = () => {
            this.expandIcon.setAttribute("src", "images/information/minus.svg");
            return (this.isExpanding = false);
        };
    }

    onAnimationFinish(open) {
        this.el.open = open;
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.el.style.height = this.el.style.overflow = "";
    }
}

document.querySelectorAll("details").forEach((el) => {
    new Accordion(el);
});
