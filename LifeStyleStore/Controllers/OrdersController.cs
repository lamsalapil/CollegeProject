using LifeStyleStore.Data.Cart;
using LifeStyleStore.Data.Services;
using LifeStyleStore.Data.ViewModels;
using Microsoft.AspNetCore.Mvc;

using System.Security.Claims;
using System.Threading.Tasks;


namespace LifeStyleStore.Controllers
{
    public class OrdersController : Controller
    {

        private readonly ProductsService _productsService;
        private readonly ShoppingCart _shoppingCart;
        private readonly IOrderService _ordersService;

        public OrdersController(ProductsService productsService, ShoppingCart shoppingCart, IOrderService ordersService)
        {
            _productsService = productsService;
            _shoppingCart = shoppingCart;
            
            _ordersService = ordersService;
        }

        public async Task<IActionResult> Index()
        {
            string userId = "";
            

            var orders = await _ordersService.GetOrdersByUserIdAsync(userId);
            return View(orders);
        }


        public IActionResult ShoppingCart()
        {
            var items = _shoppingCart.GetShoppingCartItemModels();
            _shoppingCart.ShopingCartItemModels = items;

            var response = new ShoppingCartViewModel()
            {
                ShoppingCart = _shoppingCart,
                ShoppingCartTotal = _shoppingCart.GetShopingCartTotal()
            };

            return View(response);
        }

        public async Task<RedirectToActionResult> AddToShoppingCart(int id)
        {
            var item = await _productsService.GetProductModelByIdAsnc(id);
            if(item != null)
            {
                _shoppingCart.AddItemToCart(item);

            }
            return RedirectToAction(nameof(ShoppingCart));



        }

        public async Task<IActionResult> RemoveItemFromShoppingCart(int id)
        {
            var item = await _productsService.GetProductModelByIdAsnc(id);

            if (item != null)
            {
                _shoppingCart.RemoveItemFromCart(item);
            }
            return RedirectToAction(nameof(ShoppingCart));
        }


        public async Task<IActionResult> CompleteOrder()
        {
            var items = _shoppingCart.GetShoppingCartItemModels();
            string userId = "";
            string userEmailAddress = "";

            await _ordersService.StoreOrderAsync(items, userId, userEmailAddress);
            await _shoppingCart.ClearShoppingCartAsync();

            return View("OrderCompleted");
        }


    }
}
