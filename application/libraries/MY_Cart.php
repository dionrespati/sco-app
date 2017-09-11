<?php
class MY_cart extends CI_Cart {
	public function __construct($params = array())
	{
		$this->CI =& get_instance();

		// Are any config settings being passed manually?  If so, set them
		$config = is_array($params) ? $params : array();

		// Load the Sessions class
		$this->CI->load->driver('session', $config);

		// Grab the shopping cart array from the session table
		$this->_cart_contents = $this->CI->session->userdata('cart_contents');
		if ($this->_cart_contents === NULL)
		{
			// No cart exists so we'll set some base values
			$this->_cart_contents = array('total_weight' => 0.00, 
			      'total_west_price' => 0, 
			      'total_east_price' => 0, 
			      'total_bv' => 0, 
			      'pricecode' => '', 
			      'total_items' => 0
		    );
		}

		log_message('info', 'Cart Class Initialized');
	}
	
	protected function _insert($items = array())
	{
		// Was any cart data passed? No? Bah...
		if ( ! is_array($items) OR count($items) === 0)
		{
			log_message('error', 'The insert method must be passed an array containing data.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Does the $items array contain an id, quantity, price, and name?  These are required
		if ( ! isset($items['id'], $items['qty'], $items['west_price'], $items['east_price'], $items['bv'], $items['name'], $items['weight']))
		{
			log_message('error', 'The cart array must contain a product ID, quantity, price, and name.');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Prep the quantity. It can only be a number.  Duh... also trim any leading zeros
		$items['qty'] = (float) $items['qty'];

		// If the quantity is zero or blank there's nothing for us to do
		if ($items['qty'] == 0)
		{
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the product ID. It can only be alpha-numeric, dashes, underscores or periods
		// Not totally sure we should impose this rule, but it seems prudent to standardize IDs.
		// Note: These can be user-specified by setting the $this->product_id_rules variable.
		if ( ! preg_match('/^['.$this->product_id_rules.']+$/i', $items['id']))
		{
			log_message('error', 'Invalid product ID.  The product ID can only contain alpha-numeric characters, dashes, and underscores');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Validate the product name. It can only be alpha-numeric, dashes, underscores, colons or periods.
		// Note: These can be user-specified by setting the $this->product_name_rules variable.
		if ($this->product_name_safe && ! preg_match('/^['.$this->product_name_rules.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $items['name']))
		{
			log_message('error', 'An invalid name was submitted as the product name: '.$items['name'].' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
			return FALSE;
		}

		// --------------------------------------------------------------------

		// Prep the West Code price. Remove leading zeros and anything that isn't a number or decimal point.
		$items['west_price'] = (float) $items['west_price'];
		
		// Prep the West Code price. Remove leading zeros and anything that isn't a number or decimal point.
		$items['east_price'] = (float) $items['east_price'];
		
		// Prep the wight. Remove leading zeros and anything that isn't a number or decimal point.
		$items['weight'] = (float) $items['weight'];
		
		// Prep the West Code price. Remove leading zeros and anything that isn't a number or decimal point.
		$items['bv'] = (float) $items['bv'];

		// We now need to create a unique identifier for the item being inserted into the cart.
		// Every time something is added to the cart it is stored in the master cart array.
		// Each row in the cart array, however, must have a unique index that identifies not only
		// a particular product, but makes it possible to store identical products with different options.
		// For example, what if someone buys two identical t-shirts (same product ID), but in
		// different sizes?  The product ID (and other attributes, like the name) will be identical for
		// both sizes because it's the same shirt. The only difference will be the size.
		// Internally, we need to treat identical submissions, but with different options, as a unique product.
		// Our solution is to convert the options array to a string and MD5 it along with the product ID.
		// This becomes the unique "row ID"
		if (isset($items['options']) && count($items['options']) > 0)
		{
			$rowid = md5($items['id'].serialize($items['options']));
		}
		else
		{
			// No options were submitted so we simply MD5 the product ID.
			// Technically, we don't need to MD5 the ID in this case, but it makes
			// sense to standardize the format of array indexes for both conditions
			$rowid = md5($items['id']);
		}

		// --------------------------------------------------------------------

		// Now that we have our unique "row ID", we'll add our cart items to the master array
		// grab quantity if it's already there and add it on
		$old_quantity = isset($this->_cart_contents[$rowid]['qty']) ? (int) $this->_cart_contents[$rowid]['qty'] : 0;

		// Re-create the entry, just to make sure our index contains only the data from this submission
		$items['rowid'] = $rowid;
		$items['qty'] += $old_quantity;
		$this->_cart_contents[$rowid] = $items;

		return $rowid;
	}
	
	
	protected function _update($items = array())
	{
		// Without these array indexes there is nothing we can do
		if ( ! isset($items['rowid'], $this->_cart_contents[$items['rowid']]))
		{
			return FALSE;
		}

		// Prep the quantity
		if (isset($items['qty']))
		{
			$items['qty'] = (float) $items['qty'];
			// Is the quantity zero?  If so we will remove the item from the cart.
			// If the quantity is greater than zero we are updating
			if ($items['qty'] == 0)
			{
				unset($this->_cart_contents[$items['rowid']]);
				return TRUE;
			}
		}

		// find updatable keys
		$keys = array_intersect(array_keys($this->_cart_contents[$items['rowid']]), array_keys($items));
		// if a price was passed, make sure it contains valid data
		if (isset($items['west_price']))
		{
			$items['west_price'] = (float) $items['west_price'];
		}
		
		if (isset($items['east_price']))
		{
			$items['east_price'] = (float) $items['east_price'];
		}
		
		if (isset($items['weight']))
		{
			$items['weight'] = (float) $items['weight'];
		}

		// product id & name shouldn't be changed
		foreach (array_diff($keys, array('id', 'name')) as $key)
		{
			$this->_cart_contents[$items['rowid']][$key] = $items[$key];
		}

		return TRUE;
	}
	
	protected function _save_cart()
	{
		// Let's add up the individual prices and set the cart sub-total
		$this->_cart_contents['total_items'] = $this->_cart_contents['total_west_price'] = $this->_cart_contents['total_east_price'] = $this->_cart_contents['total_bv'] = $this->_cart_contents['total_weight'] = 0;
		foreach ($this->_cart_contents as $key => $val)
		{
			// We make sure the array contains the proper indexes
			if ( ! is_array($val) OR ! isset($val['west_price'], $val['east_price'], $val['bv'], $val['qty'], $val['weight']))
			{
				continue;
			}

			$this->_cart_contents['total_west_price'] += ($val['west_price'] * $val['qty']);
			$this->_cart_contents['total_east_price'] += ($val['east_price'] * $val['qty']);
			$this->_cart_contents['total_weight'] += (float) ($val['weight'] * $val['qty']);
			$this->_cart_contents['total_bv'] += ($val['bv'] * $val['qty']);
			$this->_cart_contents['total_items'] += $val['qty'];
			
			$this->_cart_contents[$key]['subtotal_west_price'] = ($this->_cart_contents[$key]['west_price'] * $this->_cart_contents[$key]['qty']);
			$this->_cart_contents[$key]['subtotal_east_price'] = ($this->_cart_contents[$key]['east_price'] * $this->_cart_contents[$key]['qty']);
			$this->_cart_contents[$key]['subtotal_weight'] = (float) ($this->_cart_contents[$key]['weight'] * $this->_cart_contents[$key]['qty']);
			
		}

		// Is our cart empty? If so we delete it from the session
		if (count($this->_cart_contents) <= 2)
		{
			$this->CI->session->unset_userdata('cart_contents');

			// Nothing more to do... coffee time!
			return FALSE;
		}

		// If we made it this far it means that our cart has data.
		// Let's pass it to the Session class so it can be stored
		$this->CI->session->set_userdata(array('cart_contents' => $this->_cart_contents));

		// Woot!
		return TRUE;
	}
	
	public function total_items()
	{
		return $this->_cart_contents['total_items'];
	}
	
	public function total_weight()
	{
		return $this->_cart_contents['total_weight'];
	}
	
	public function total_bv()
	{
		return $this->_cart_contents['total_bv'];
	}
	
	public function pricecode()
	{
		return $this->_cart_contents['pricecode'];
	}
	
	public function set_pricecode($value) {
		$this->_cart_contents['pricecode'] = $value;
	}
	
	
	public function total_west_price()
	{
		return $this->_cart_contents['total_west_price'];
	}
	
	public function total_east_price()
	{
		return $this->_cart_contents['total_east_price'];
	}
	
		
	public function contents($newest_first = FALSE)
	{
		// do we want the newest first?
		$cart = ($newest_first) ? array_reverse($this->_cart_contents) : $this->_cart_contents;

		// Remove these so they don't create a problem when showing the cart table
		unset($cart['total_items']);
		unset($cart['total_west_price']);
		unset($cart['total_east_price']);
		unset($cart['total_weight']);
		unset($cart['total_bv']);
		unset($cart['pricecode']);

		return $cart;
	}
	
	public function get_item($row_id)
	{
		return (in_array($row_id, array('total_weight', 'total_items', 'total_west_price', 'total_east_price', 'total_bv', 'pricecode'), TRUE) OR ! isset($this->_cart_contents[$row_id]))
			? FALSE
			: $this->_cart_contents[$row_id];
	}
	
	public function destroy()
	{
		$this->_cart_contents = array('total_weight' => 0, 'total_west_price' => 0, 'total_east_price' => 0, 'total_bv' => 0, 'pricecode' => '', 'total_items' => 0);
		$this->CI->session->unset_userdata('cart_contents');
	}
}