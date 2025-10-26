import { Controller } from '@hotwired/stimulus';
export default class extends Controller {

    static values = {
        dialogId: String
    }

    handleClick() {
        const drawer = document.querySelector(`#${this.dialogIdValue}`);
        drawer.open = true
    }

}
