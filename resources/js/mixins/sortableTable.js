export default {
    data: () => ({
        sortTableType: "asc",
        sortTableCol: ""
    }),

    methods: {
        sortable() {
            return this[`${this.sortTableType}SortTable`];
        },

        toggleSortTable(col) {
            this.sortTableCol = col;
            this.sortTableType = this.sortTableType === "asc" ? "desc" : "asc";
        },

        ascSortTable(a, b) {
            return a[this.sortTableCol] > b[this.sortTableCol] ? 1 : -1;
        },

        descSortTable(a, b) {
            return a[this.sortTableCol] > b[this.sortTableCol] ? -1 : 1;
        }
    }
};
