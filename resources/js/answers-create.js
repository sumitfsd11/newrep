import dayjs from "dayjs";
import customParseFormat from "dayjs/plugin/customParseFormat";
dayjs.extend(customParseFormat);

export default function answer_data(survey, initial_content = {}) {
    const contents = {};
    const pages = [[]];
    survey.forEach((content) => {
        if (
            content.type === "checkbox" ||
            content.type === "drag_and_drop_ranking" ||
            content.type === "image_multiselect"
        ) {
            contents[content.name] = initial_content[content.name] || [];
        } else if (
            content.type === "likert_grid" ||
            content.type === "radio_grid" ||
            content.type === "textbox_list" ||
            content.type === "continuous_sum"
        ) {
            contents[content.name] =
                initial_content[content.name] ||
                _.defaults(...content.questions.map((q) => ({ [q.name]: "" })));
        } else if (content.type === "checkbox_grid") {
            contents[content.name] =
                initial_content[content.name] ||
                _.defaults(...content.questions.map((q) => ({ [q.name]: [] })));
        } else if (content.type == "slider") {
            contents[content.name] =
                initial_content[content.name] || content.default;
        } else if (content.type == "slider_list") {
            contents[content.name] =
                initial_content[content.name] ||
                _.defaults(
                    ...content.questions.map((q) => ({
                        [q.name]: content.default,
                    }))
                );
        } else if (content.type == "page_break") {
            pages.push([]);
        } else {
            contents[content.name] = initial_content[content.name] || "";
        }
        // just push name to pages
        if (content.type !== "page_break")
            pages[pages.length - 1].push(content.name);
    });
    // pop last page if empty
    if (pages[pages.length - 1].length === 0) pages.pop();

    return {
        current_page: 0,
        survey: survey,
        compute_logic(item) {
            for (let i = 0; i < item.logics.length; i++) {
                const logic = item.logics[i];
                if (logic.type === "skip") {
                    if (this.contents[logic.name] === logic.value) {
                        return false;
                    }
                }
            }
            return true;
        },
        pages: pages,
        contents: contents,
        readonly: false,
        disabled: false,
        make_numeric(n) {
            if (isNaN(n) || n === "") {
                return 0;
            } else {
                return n;
            }
        },
        make_readonly() {
            this.readonly = true;
        },
        disable() {
            this.disabled = true;
        },

        validate_required() {
            for (let i = 0; i < this.survey.length; i++) {
                const self = this.survey[i];

                // check if date is valid
                if (self.type === "date") {
                    if (this.contents[self.name] === "Invalid Date") {
                        console.log("Invalid date");
                        return 1;
                    }
                }

                // check if all items ranked
                if (self.type === "drag_and_drop_ranking") {
                    if (
                        this.contents[self.name].length &&
                        this.contents[self.name].length !== self.options.length
                    ) {
                        console.log("Not all items ranked");
                        return 1;
                    }
                }

                // separate validation for likert_grid and radio_grid
                if (
                    self.required &&
                    (self.type === "likert_grid" ||
                        self.type === "radio_grid" ||
                        self.type === "textbox_list" ||
                        self.type === "slider_list" ||
                        self.type === "continuous_sum")
                ) {
                    for (let j = 0; j < self.questions.length; j++) {
                        const q = self.questions[j];
                        if (this.contents[self.name][q.name] === "") {
                            console.log("Required likert group field is empty");
                            return 1;
                        }
                    }
                } else if (self.required && self.type === "checkbox_grid") {
                    for (let j = 0; j < self.questions.length; j++) {
                        const q = self.questions[j];
                        if (this.contents[self.name][q.name].length === 0) {
                            console.log(
                                "Required checkbox group field is empty"
                            );
                            return 1;
                        }
                    }
                } else if (self.required && self.type === "slider") {
                    // pass;
                } else {
                    if (self.required && !this.contents[self.name].length) {
                        // if logic hides this field, it is not required
                        if (!this.compute_logic(self)) continue;
                        console.log("Required field is empty");
                        return 1;
                    }
                }
            }
            return 0;
        },
    };
}
