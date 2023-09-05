import Chart from "chart.js/auto";
import _ from "lodash";
import uniqolor from "uniqolor";

const make_chart = (canvas_id, data, pics) => {
    const count = _.countBy(data.answers);
    const ctx = document.getElementById(canvas_id).getContext("2d");

    // merge null and empty string values
    if (count[""] !== undefined) {
        count[""] += count["null"] ?? 0;
        delete count["null"];
    }

    const keys = [];
    const values = [];

    Object.entries(count)
        .sort(([, a], [, b]) => b - a)
        .forEach(([key, value]) => {
            keys.push(key);
            values.push(value);
        });

    const labels = keys.map(
        (value) =>
            data.content.options.find((op) => op.value === value)?.option ??
            "Did not answer"
    );

    if (data.content.type === "image_singleselect") {
        // change the labels to the image names
        labels.forEach((label, index) => {
            labels[index] = pics[label] ?? label;
        });
    }

    const chart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [
                {
                    label: data.content.label,
                    data: values,
                    backgroundColor: labels.map((l) => uniqolor(l).color),
                    hoverOffset: 4,
                },
            ],
        },
    });
    return chart;
};

const alpine_pie = {
    make(id, content, answers, pics) {
        const data = { content, answers };
        const chart = make_chart(id, data, pics);
    },
};

export { alpine_pie };
