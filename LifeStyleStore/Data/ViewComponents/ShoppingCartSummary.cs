using LifeStyleStore.Data.Cart;
using Microsoft.AspNetCore.Mvc;

namespace LifeStyleStore.Data.ViewComponents
{
    
    public class ShoppingCartSummary: ViewComponent
    {
        private readonly ShoppingCart _shoppingCart;

        public ShoppingCartSummary(ShoppingCart shoppingCart)
        {
            _shoppingCart = shoppingCart;

        }   

        public IViewComponentResult Invoke()
        {
            var items = _shoppingCart.GetShoppingCartItemModels();

            return View(items.Count);
        }


    }
}
