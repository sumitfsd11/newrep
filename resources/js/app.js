import "./bootstrap";

import.meta.glob(["../images/**"]);

import Alpine from "alpinejs";
import { alpine_pie } from "./radio-pie-chart";
import { alpine_bar } from "./radio-bar-chart";
import { alpine_checkbox_bar } from "./checkbox-bar-chart";
import { alpine_date_line } from "./date-line-chart";
import dayjs from "dayjs";
import customParseFormat from "dayjs/plugin/customParseFormat";
dayjs.extend(customParseFormat);

window.dayjs = dayjs;
window.Alpine = Alpine;

import handler from "./surveys-create";
window.handler = handler;

import answer_data from "./answers-create";
window.answer_data = answer_data;

import drag_and_drop_alpine from "./drag_and_drop_alpine";
window.drag_and_drop_alpine = drag_and_drop_alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("alpine_pie", () => ({ ...alpine_pie }));
    Alpine.data("alpine_bar", () => ({ ...alpine_bar }));
    Alpine.data("alpine_checkbox_bar", () => ({ ...alpine_checkbox_bar }));
    Alpine.data("alpine_date_line", () => ({ ...alpine_date_line }));
    Alpine.data('myForm', () => ({
        response: '',
        submitForm(event) {
            fetch(event.target.action, {
                method: 'POST',
                body: new FormData(event.target),
            })
            .then(response => response.text())
            .then(data => {
                this.response = data; // Update the response
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }));
});

Alpine.start();
import { themeChange } from "theme-change";
themeChange();





