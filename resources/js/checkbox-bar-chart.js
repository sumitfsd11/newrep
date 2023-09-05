import Chart from "chart.js/auto";
import _ from "lodash";
import uniqolor from "uniqolor";

const make_chart = (canvas_id, data, pics) => {
    const total_answers = data.answers.length;
    const all_options = data.content.options.map((op) => op.value);
    // make options_count object with all options and 0 as value
    const options_count = all_options.reduce((obj, option) => {
        obj[option] = 0;
        return obj;
    }, {});

    // foreach ans in answers, foreach a in ans, increment options_count[a]
    // ans might be null, so we need to check for that
    data.answers.forEach((ans) => {
        if (ans !== null) {
            ans.forEach((a) => {
                options_count[a] += 1;
            });
        }
    });

    // convert key => value to key => percentage
    const percentage = Object.fromEntries(
        Object.entries(options_count).map(([key, value]) => [
            key,
            (value / total_answers) * 100,
        ])
    );

    const keys = [];
    const values = [];

    // sort by percentage
    Object.entries(percentage)
        .sort(([, a], [, b]) => b - a)
        .forEach(([key, value]) => {
            keys.push(key);
            values.push(value.toFixed(2));
        });

    if (data.content.type === "image_multiselect") {
        // change the labels to the image names
        keys.forEach((label, index) => {
            keys[index] = pics[label] ?? label;
        });
    }

    const ctx = document.getElementById(canvas_id).getContext("2d");
    const chart = new Chart(ctx, {
        type: "bar",
        options: {
            indexAxis: "y",
            scales: {
                x: {
                    ticks: {
                        callback: function (value, index, values) {
                            return value + "%";
                        },
                    },
                },
            },
        },
        data: {
            labels: keys,
            datasets: [
                {
                    label: data.content.label,
                    data: values,
                    backgroundColor: keys.map((l) => uniqolor(l).color),
                    hoverOffset: 4,
                },
            ],
        },
    });
    return chart;
};

const alpine_checkbox_bar = {
    make(id, content, answers, pics) {
        const data = { content, answers };
        const chart = make_chart(id, data, pics);
    },
};

export { alpine_checkbox_bar };
