    /** @jsx React.DOM */
    var menuElement = React.createClass({

    	clickHandler: function(){
    	
    		 this.props.onClick(this.props.ref);
    	},

    	render: function(){
    		return (
    				<li onClick={this.clickHandler}>
	    				{this.props.name} {this.props.price}
    				</li>
    			);
    	}

    });



    var entireMenu = React.createClass({

        getInitialState: function(){
            return { total: 0, menuElements: [], orderElements: [] };
        },
        
        kEbenyam: function(){
        	var menuElements = this.state.menuElements;
        	this.setState({menuElements: menuElements, orderElements: [], total: 0});
        },

        componentDidMount: function(){ 
            var self = this;
            var url  = 'menu.json';

            $.getJSON(url, function(result){
            	console.log(url);
            if(!result || !result.length){
                return;
            }

                var menuElements = result.map(function(p){
                    return {
                        id: p.id,
                        name: p.name,
                        price: p.price,
                        isCoffee: p.isCoffee,
                    };

                });
                self.setState({ menuElements: menuElements });
            });
        },

        menuElementClick: function(id){

            var orderElements = this.state.orderElements,
                menuElements  = this.state.menuElements,
                total		  = this.state.total;

            for (var i = 0; i < menuElements.length; i++) {
                if (menuElements[i].id == id) {
						this.orderElementClick(id);
                        orderElements.push(menuElements[i]);
                        total += Number(menuElements[i].price);
                        break;
                }
            }

            this.setState({menuElements: menuElements, orderElements: orderElements, total: total});
        },

        orderElementClick: function(id){

            var orderElements = this.state.orderElements,
                menuElements  = this.state.menuElements;


            this.setState({menuElements: menuElements, orderElements: orderElements});

        },

        render: function(){

            var self = this;

            var menuElements = this.state.menuElements.map(function(s){
                return <menuElement ref={s.id} name={s.name} price={s.price} onClick={self.menuElementClick} />;
            });

            if(!menuElements.length){
                menuElements = <div><br/><br/><p>Загрузка данных с сервера...</p></div>;
            }

            var orderElements = this.state.orderElements.map(function(s){
                return <menuElement ref={s.id} name={s.name} price={s.price} onClick={self.orderElementClick} />;
            });

            if(!orderElements.length){
                orderElements = <div><br/><br/><i>Тыкай по элементам, ёба</i></div>;
            }

            return (
                <div>
                    <div className="menu-items">
                        <h4>Меню</h4>
                        <ul id="list-of-items-in-stock">
                            {menuElements}
                        </ul>
                        <div className="clear"></div>
                    </div>
                    <div className="order">
                        <h4>Заказ</h4> 
                        <ul id="order-list">
                        	{orderElements}
                        </ul>
                        <div className="clear"></div>
                        <br/>
                        <strong>Сумма заказа: {this.state.total.toFixed(2)} руб</strong>
                        <br/><br/>
                       <button onClick={this.kEbenyam}>Удалить все к ебеням</button>
                    </div>
                </div>
            );
        }
    });


        React.renderComponent(
        <entireMenu />,
        document.getElementById('menu')

    );