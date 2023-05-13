using System.Collections.Generic;
using System.Threading.Tasks;
using System;
using LifeStyleStore.Models;

using Microsoft.EntityFrameworkCore;
using System.Linq;

namespace LifeStyleStore.Data.Services
{

    public class OrdersService : IOrderService
    {
        private readonly AdDbContext _context;
        public OrdersService(AdDbContext context)
        {
            _context = context;
        }

        public async Task<List<OrderModel>> GetOrdersByUserIdAsync(string userId)
        {
            var orders = await _context.orderModels.Include(n => n.OrderItemModel).ThenInclude(n => n.ProductModel).Where(n => n.UserId == userId).ToListAsync();

           

            return orders;
        }

        

        public async Task StoreOrderAsync(List<ShoppingCartItemModel> items, string userId, string userEmailAddress)
        {
            var order = new OrderModel()
            {
                UserId = userId,
                Email = userEmailAddress
            };
            await _context.orderModels.AddAsync(order);
            await _context.SaveChangesAsync();

            foreach (var item in items)
            {
                var orderItem = new OrderItemModel()
                {
                    Amount = item.Amount,
                    ProductID = item.ProductModel.Id,
                    OrderID = order.Id,
                   price = item.ProductModel.Price
                };
                await _context.orderItemModels.AddAsync(orderItem);
            }
            await _context.SaveChangesAsync();
        }
    }
}
