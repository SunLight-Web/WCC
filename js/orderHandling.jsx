    /** @jsx React.DOM */   
        var clientHandler = React.createClass({
	    	getInitialState: function(){
	    		return { name: '', coffees: 0, bonuses: 0, cardnum : 0 };
	    	},

	    	submitHandle: function(e){
	    		e.preventDefault();
	    		var cardnum = this.refs.cardnum.getDOMNode().value.trim();
	    		var query = 'cardProceed.php?cardnum=' + cardnum;
	    		    $.get(query, function(result) {
	    		    	var client = jQuery.parseJSON(result);
	    		    	if (!client.noElements){
	    		    		this.setState({name: client.name, coffees: client.coffees, bonuses: client.bonuses, noBonuses: client.noBonuses, cardnum: cardnum});
	    		    	}
				    }.bind(this));
	    	},

	    	render: function(){
	    		var clientsNameDiv;
	    		var bonusInfo;

		    	if (this.state.noBonuses) {
		    		bonusInfo = <strong>Бонусов, естественно, нихуя.</strong>
		    	} else {
		    		bonusInfo = <div>Текущее количество бонусов: <strong>{this.state.bonuses}</strong></div>
		    	}

	    		if (this.state.name == '') {
					clientsNameDiv = <div>Хуй знает как зовут клиента, но.</div>
	    		} else {
	    			clientsNameDiv = <div>Клиента зовут <strong>{this.state.name}</strong>.</div>
	    		}

	    		return (
	    		<div>
	    		<h4>Клиент</h4>
	    			<div>
	    				<form id="clientForm" onSubmit={this.submitHandle}>
	    					<label htmlFor="cardnumInput">Номер карты:</label>
	    					<input type="text" id="cardnumInput" onchange={this.submitHandle} ref='cardnum' maxLength="4"/> <br/>
	    				</form>
	    			</div>
	    			{clientsNameDiv}
					Человек купил у нас <strong>{this.state.coffees}</strong> кофе.
	    			<br/>
	    			{bonusInfo}
	    			<menuAndOrder cardnum={this.state.cardnum}/>
	    		</div>
	    		);
	    	}


    });

    var menuElement = React.createClass({

    	clickHandler: function(){
    	
    		 this.props.onClick(this.props.ref);
    	},

    	render: function(){
 			var isLiquid;
 			if (this.props.isCoffee == 1) {isLiquid = 'мл'} else {isLiquid = 'шт'};
    		return (
    				<li onClick={this.clickHandler}>
	    				<span>{this.props.name}</span><strong>{this.props.quanity}</strong>
	    				<br/>
						{this.props.amount}{isLiquid} 
	    				<br/>
	    				<i>{this.props.price}₽</i>
	    				
    				</li>
    			);
    	}

    });

    var menuAndOrder = React.createClass({

        getInitialState: function(){
            return { total: 0, menuElements: [], orderElements: []};
        },
        
        kEbenyam: function(){
        	var menuElements = this.state.menuElements;
       		menuElements.map(function(e){
       			e.quanity = 0
       		});
        	this.setState({menuElements: menuElements, orderElements: [], total: 0 });
        	document.getElementById('cardnumInput').value = '';
        },

        proceed: function(){
        	var orderElements = this.state.orderElements;
	        	if (confirm('Уверен вообще?')) {
	        		var toParse = [];
	        		var idset = [];    		
		            var cash;
		            var coffees = 0;
		            var cardnum = this.props.cardnum;
		        	if (orderElements.length != 0) {
			            for (var i = 0; i < orderElements.length; i++) {
							idset += '.' + orderElements[i].id;
							while (orderElements[i].quanity != 1){
								idset += '.' + orderElements[i].id;
								orderElements[i].quanity--;
							}
							if (orderElements[i].isCoffee){
								coffees++;
							}
		                }
		            idset = idset.substring(1);
		            }

	                cash = this.state.total;
	                toParse = {cardnum: cardnum, idset:idset, cash:cash, coffees:coffees};
	                

					$.post( "checkandsave.php", toParse, function(data) {
						var tooltip;
						var text;
						text 	= document.getElementById('tooltipText');
						tooltip = document.getElementById('tooltip');
						tooltip.style.display = 'inline';
						text.innerHTML = data;
					});
        		this.kEbenyam();
        	}
        },

        componentDidMount: function(){ 
            var self = this;
            var url  = 'menu.json';

            $.getJSON(url, function(result){
            if(!result || !result.length){
                return;
            }

                var menuElements = result.map(function(p){
                    return {
                        id: p.id,
                        name: p.name,
                        price: p.price,
                        amount: p.amount,
                        isCoffee: p.isCoffee,
                        quanity: 0
                    };

                });
                self.setState({ menuElements: menuElements });
            });
        },

        menuElementClick: function(id){

            var orderElements	  = this.state.orderElements,
                menuElements      = this.state.menuElements,
                total			  = this.state.total,
                inOrdersAlready	  = false;

            for (var i = 0; i < orderElements.length; i++) {
                if (orderElements[i].id == id) {
                		inOrdersAlready = true;
                    break;
                }
            }

            for (var i = 0; i < menuElements.length; i++) {
                if (menuElements[i].id == id) {
                	menuElements[i].quanity +=1;
                	if (menuElements[i].isCoffee){
                		this.props.bonuses++;
                	}
                	if (!inOrdersAlready){
                   		orderElements.push(menuElements[i]);
                	}
                	total += Number(menuElements[i].price);
                    break;
                }
            }

            this.setState({menuElements: menuElements, orderElements: orderElements, total: total});
        },

        orderElementClick: function(id){
            var orderElements = this.state.orderElements,
                menuElements  = this.state.menuElements,
                total		  = this.state.total;

            for (var i = 0; i < orderElements.length; i++) {
                if (orderElements[i].id == id) {
                	total -= Number(orderElements[i].price);
                	orderElements[i].quanity -= 1;
                	if (orderElements[i].quanity == 0){
                		orderElements.splice(i, 1);
                	} 
                	break;
            	}
            }
            this.setState({menuElements: menuElements, orderElements: orderElements, total: total});

        },

        render: function(){

            var self = this;

            var menuElements = this.state.menuElements.map(function(s){
                return <menuElement ref={s.id} name={s.name} price={s.price} isCoffee={s.isCoffee} amount={s.amount} onClick={self.menuElementClick} />;
            });

            if(!menuElements.length){
                menuElements = <div><br/><br/><p>Загрузка данных с сервера...</p></div>;
            }

            var orderElements = this.state.orderElements.map(function(s){
                return <menuElement ref={s.id} name={s.name} price={(s.price*s.quanity).toFixed(2)} isCoffee={s.isCoffee} amount={s.amount} quanity={s.quanity} onClick={self.orderElementClick} />;
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
                       <button onClick={this.proceed}>Хуйнуть в бд</button>
                    </div>
                </div>
            );
        }
    });


        React.renderComponent(
        <clientHandler/>,
        document.getElementById('menu-react-mount')

    );