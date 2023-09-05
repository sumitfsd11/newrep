const add_text = {
    type: "text",
    name: "",
    label: "",
    required: false,
    logics: [],
};

const add_checkbox = {
    type: "checkbox",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

const add_description = {
    type: "description",
    name: "",
    label: "",
    required: false,
    logics: [],
};

const add_radio = {
    type: "radio",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

const add_drag_and_drop_ranking = {
    type: "drag_and_drop_ranking",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

const add_likert = {
    type: "likert",
    name: "",
    label: "",
    options: [
        { option: "Very Dissatisfied", value: "very-dissatisfied" },
        { option: "Dissatisfied", value: "dissatisfied" },
        { option: "Neutral", value: "neutral" },
        { option: "Satisfied", value: "satisfied" },
        { option: "Very Satisfied", value: "very-satisfied" },
    ],
    required: false,
    logics: [],
};

const add_likert_grid = {
    type: "likert_grid",
    name: "",
    label: "",
    questions: [],
    options: [
        { option: "Very Dissatisfied", value: "very-dissatisfied" },
        { option: "Dissatisfied", value: "dissatisfied" },
        { option: "Neutral", value: "neutral" },
        { option: "Satisfied", value: "satisfied" },
        { option: "Very Satisfied", value: "very-satisfied" },
    ],
    required: false,
    logics: [],
};

const add_slider_list = {
    type: "slider_list",
    name: "",
    label: "",
    min: 0,
    max: 10,
    step: 1,
    default: 5,
    label_min: "",
    label_max: "",
    label_mid: "",
    required: false,
    logics: [],
    questions: [],
};

const add_radio_grid = {
    type: "radio_grid",
    name: "",
    label: "",
    questions: [],
    options: [],
    required: false,
    logics: [],
};

const add_checkbox_grid = {
    type: "checkbox_grid",
    name: "",
    label: "",
    questions: [],
    options: [],
    required: false,
    logics: [],
};

const add_slider = {
    type: "slider",
    name: "",
    label: "",
    min: 0,
    max: 10,
    step: 1,
    default: 5,
    label_min: "",
    label_max: "",
    label_mid: "",
    required: false,
    logics: [],
};

const add_select = {
    type: "select",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

const add_date = {
    type: "date",
    name: "",
    label: "",
    required: false,
    logics: [],
    format: "YYYY-MM-DD",
};

const add_date_picker = {
    type: "date_picker",
    name: "",
    label: "",
    min: "",
    max: "",
    required: false,
    logics: [],
};

const add_textbox_list = {
    type: "textbox_list",
    name: "",
    label: "",
    questions: [],
    required: false,
    logics: [],
};

const add_continuous_sum = {
    type: "continuous_sum",
    name: "",
    label: "",
    questions: [],
    required: false,
    logics: [],
};

const add_image_multiselect = {
    type: "image_multiselect",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

const add_image_singleselect = {
    type: "image_singleselect",
    name: "",
    label: "",
    options: [],
    required: false,
    logics: [],
};

export {
    add_text,
    add_checkbox,
    add_description,
    add_radio,
    add_drag_and_drop_ranking,
    add_likert,
    add_likert_grid,
    add_slider_list,
    add_radio_grid,
    add_checkbox_grid,
    add_slider,
    add_select,
    add_date,
    add_date_picker,
    add_textbox_list,
    add_continuous_sum,
    add_image_multiselect,
    add_image_singleselect,
};
