import Chart from "chart.js/auto";
import _ from "lodash";
import uniqolor from "uniqolor";
import dayjs from "dayjs";

const make_chart = (canvas_id, data, pics) => {
    const count = _.countBy(data.answers);
    // drop null and empty string
    delete count[""];
    delete count["null"];

    let modded_data;
    if (data.content.type === "date_picker") {
        modded_data = Object.keys(count).reduce((acc, key) => {
            const timestamp = dayjs(key).unix();
            acc[timestamp] = count[key];
            return acc;
        }, {});
    } else if (data.content.type === "slider") {
        modded_data = count;
    }

    const sortedData = Object.entries(modded_data)
        .sort((a, b) => a[0] - b[0])
        .reduce(
            (acc, [key, value]) => {
                acc.keys.push(key);
                acc.values.push(value);
                return acc;
            },
            { keys: [], values: [] }
        );
    let labels;
    if (data.content.type === "date_picker") {
        labels = sortedData.keys.map((value) =>
            // convert to YYYY-MM-DD
            dayjs.unix(value).format("YYYY-MM-DD")
        );
    } else if (data.content.type === "slider") {
        labels = sortedData.keys;
    }

    const ctx = document.getElementById(canvas_id).getContext("2d");
    const chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: data.content.label,
                    data: sortedData.values,
                    backgroundColor: labels.map((l) => uniqolor(l).color),
                    hoverOffset: 4,
                },
            ],
        },
    });

    return chart;
};

const alpine_date_line = {
    make(id, content, answers, pics) {
        const data = { content, answers };
        const chart = make_chart(id, data, pics);
    },
};

export { alpine_date_line };
