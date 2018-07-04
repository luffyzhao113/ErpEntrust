export default {
  computed: {
    uuid(){
      let now = Date.now();
      return `me-${now}-${this._uid}`;
    }
  }
}