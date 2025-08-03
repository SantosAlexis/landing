// navigation.js
class Navigation {
    constructor() {
        this.links = {
            home: document.getElementById("homeLink"),
            offer: document.getElementById("offerLink"),
            refer: document.getElementById("referLink"),
            selfEval: document.getElementById("selfEvalLink")
        };
        this.sections = {
            home: document.getElementById("homeSection"),
            offer: document.getElementById("offerSection"),
            refer: document.getElementById("referSection"),
            selfEval: document.getElementById("selfEvalSection")
        };
    }

    init() {
        this.addEventListeners();
    }

    addEventListeners() {
        this.links.home.addEventListener("click", () => this.showSection("home"));
        this.links.offer.addEventListener("click", () => this.showSection("offer"));
        this.links.refer.addEventListener("click", () => this.showSection("refer"));
        this.links.selfEval.addEventListener("click", () => this.showSection("selfEval"));
    }

    showSection(section) {
        Object.keys(this.sections).forEach((key) => {
            if (key === section) {
                this.sections[key].classList.add("active");
            } else {
                this.sections[key].classList.remove("active");
            }
        });
    }
}

const navigation = new Navigation();
navigation.init();
