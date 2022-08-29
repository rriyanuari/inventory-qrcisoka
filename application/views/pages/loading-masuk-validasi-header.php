<style>
  body, html {
  padding: 0;
  margin: 0;
  font-family: 'Helvetica Neue', 'Calibri', Arial, sans-serif;
  height: 100%;
}
#app {
  background: #263238;
  display: flex;
  align-items: stretch;
  justify-content: stretch;
  height: 100%;
}
.sideApp {
  background: #eceff1;
  min-width: 250px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  overflow: auto;
}
.sideApp h2 {
  font-weight: normal;
  font-size: 1.0rem;
  background: #607d8b;
  color: #fff;
  padding: 10px;
  margin: 0;
}
.sideApp ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
.sideApp li {
  line-height: 175%;
  white-space: nowrap;
  overflow: hidden;
  text-wrap: none;
  text-overflow: ellipsis;
}
.cameras ul {
  padding: 15px 20px;
}
.cameras .active {
  font-weight: bold;
  color: #009900;
}
.cameras a {
  color: #555;
  text-decoration: none;
  cursor: pointer;
}
.cameras a:hover {
  text-decoration: underline;
}
.scans li {
  padding: 10px 20px;
  border-bottom: 1px solid #ccc;
}
.scans-enter-active {
  transition: background 3s;
}
.scans-enter {
  background: yellow;
}
.empty {
  font-style: italic;
}
.preview-container {
  flex-direction: column;
  align-items: center;
  justify-content: center;
  display: flex;
  width: 100%;
  overflow: hidden;
}


</style>