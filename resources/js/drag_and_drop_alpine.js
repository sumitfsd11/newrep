export default function drag_and_drop_alpine() {
    return {
        belongs_to: null,
        dragging: false,
        dragged: null,
        over: null,
        dragstart: function (op_index, node, index) {
            this.belongs_to = index;
            this.dragged = op_index;
            this.dragging = true;
        },
        dragend: function (ev) {
            if (ev.dataTransfer.dropEffect == "move") {
                if (this.belongs_to == this.over) {
                    this.dragging = false;
                    this.dragged = null;
                    this.belongs_to = null;
                    this.over = null;
                    return true;
                } else {
                    return false;
                }
            } else {
                this.dragging = false;
                this.dragged = null;
                this.belongs_to = null;
                this.over = null;
                return false;
            }
        },
        dragover(index) {
            if (index == this.belongs_to) {
                event.preventDefault();
            }
        },
        dragenter(index) {
            if (index == this.belongs_to) this.over = index;
        },
        dragleave(index, node) {
            this.over = null;
        },
    };
}
