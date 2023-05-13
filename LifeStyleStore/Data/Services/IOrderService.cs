
using LifeStyleStore.Models;
using System.Collections.Generic;
using System.Threading.Tasks;

namespace LifeStyleStore.Data.Services
{
    public interface IOrderService
    {
        Task StoreOrderAsync(List<ShoppingCartItemModel> item, string userId, string userEmailAddress);

        Task<List<OrderModel>> GetOrdersByUserIdAsync(string userId);
       
        
    }
}
