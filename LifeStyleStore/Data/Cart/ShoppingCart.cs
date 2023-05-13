using LifeStyleStore.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace LifeStyleStore.Data.Cart
{
    public class ShoppingCart
    {
        public AdDbContext _context { get; set; }

        public string ShoppingCartId { get; set; }

        public List<ShoppingCartItemModel> ShopingCartItemModels { get; set; }

        public ShoppingCart(AdDbContext context)
        {
            _context = context;
        }
        
        public static ShoppingCart GetShoppingCart(IServiceProvider services)
        {
            ISession session = services.GetRequiredService<IHttpContextAccessor>()?.HttpContext.Session;
            var context = services.GetService<AdDbContext>();

            string cartId = session.GetString("CartId") ?? Guid.NewGuid().ToString();
            session.SetString("CartId", cartId);

            return new ShoppingCart(context) { ShoppingCartId = cartId };
        }


        public void AddItemToCart(ProductModel productModel)
        {
            var shoppingCartItem = _context.ShoppingCartItemModels.FirstOrDefault(n => n.ProductModel.Id == productModel.Id && n.ShoppingCartId == ShoppingCartId);

            if (shoppingCartItem == null)
            {
                shoppingCartItem = new ShoppingCartItemModel()
                {
                    ShoppingCartId = ShoppingCartId,
                    ProductModel = productModel,
                    Amount = 1
                };

                _context.ShoppingCartItemModels.Add(shoppingCartItem);

            }
            else
            {
                shoppingCartItem.Amount++;

            }
            _context.SaveChanges();
        }

        public void RemoveItemFromCart(ProductModel productModel)
        {
            var shoppingCartItem = _context.ShoppingCartItemModels.FirstOrDefault(n => n.ProductModel.Id == productModel.Id && n.ShoppingCartId == ShoppingCartId);

            if (shoppingCartItem != null)
            {
               if (shoppingCartItem.Amount > 1)
                {
                    shoppingCartItem.Amount--;
                }
                else
                {
                    _context.ShoppingCartItemModels.Remove(shoppingCartItem);
                }

                

            }
           
            _context.SaveChanges();
        }

        

        public List <ShoppingCartItemModel> GetShoppingCartItemModels()
        {
            return ShopingCartItemModels ?? (ShopingCartItemModels = _context.ShoppingCartItemModels.Where(n => n.ShoppingCartId == ShoppingCartId).Include(n => n.ProductModel).ToList());
            
        }

        public double GetShopingCartTotal() => _context.ShoppingCartItemModels.Where(n => n.ShoppingCartId == ShoppingCartId).Select(n => n.ProductModel.Price * n.Amount).Sum();


        public async Task ClearShoppingCartAsync()
        {
            var items = await _context.ShoppingCartItemModels.Where(n => n.ShoppingCartId == ShoppingCartId).ToListAsync();
            _context.ShoppingCartItemModels.RemoveRange(items);
            await _context.SaveChangesAsync();
        }

    }
}
