import http from "./http";

export default {
  mixins: [http],
  data(){
    return {
      searchForm: {},
      data: {
        data:[],
        page:{
          total: 0,
          current: 1,
          page_size: 20
        }
      },
      component:{
        current: '',
        data: {}
      },
    }
  },
  mounted(){
    this.search()
  },
  methods:{
    search(page = 1){

    },
    assignmentData(data){
      this.data.data = data.data;
      this.data.page.total = data.total
      this.data.page.current = data.current_page
      this.data.page.page_size = data.per_page
    },
    showComponent(type, data){
      this.component.current = type
      this.component.data = data
    },
    hideComponent(){
      this.component.current = ''
      this.component.data = {}
      this.search()
    },
    destroyItem(row, url){
      this.$http.delete(url).then((res) => {
        this.search()
      }).catch((res) => {
        this.formatErrors(res)
      });
    },
    request(page){
        let searchForm = JSON.parse(JSON.stringify(this.searchForm));
        searchForm.page = page
        return searchForm;
    }
  }
}